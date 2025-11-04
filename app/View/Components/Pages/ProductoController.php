<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use App\Models\AccesoryPdf;
use App\Models\Product;
use App\Models\SpecialityArea;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\View\Component;
use Log;
use Exception;
use Psy\Command\WhereamiCommand;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\DB;
class ProductoController extends Controller
{


   public function showBySearch($slug, Request $request)
    {
        $searchTerm = str_replace('-', ' ', $slug);
        $content = $this->getProductsBySearch($searchTerm, $request->input('filter', []));
        $products = json_encode($content);
        $accesoryPdf = $this->getAccesoryPdfs();

        return view('product', [
            'info' => $searchTerm, 
            'content' => json_decode($products),
            'accesoryPdf' => $accesoryPdf
        ]);
    }

    /**
     * Obtiene productos buscando un término en nombres, categorías y áreas de especialidad.
     */
    public function getProductsBySearch($searchTerm, $appliedFilters = [])
    {
        // Convertir el término de búsqueda a minúsculas
        $searchTermLike = '%' . strtolower($searchTerm) . '%'; 

        try {
            $query = Product::with([
                'brand:id,name',
                'category:id,name', // 'category' aquí es el nombre de la *relación* en tu Modelo Product
                'productSpecAreas.specArea:id,name',
                'productImages:id,product_id,url,type,index,active'
            ])
            
            // ---- INICIO DE LA CORRECCIÓN ----
            
            // 1. Unir la tabla pivote de categorías
            // ¡IMPORTANTE! Asumo que tu tabla pivote es 'category_product'
            // Si es 'product_category' u otra, cámbiala aquí.
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            
            // 2. Unir la tabla pivote de áreas de especialidad (esta ya estaba bien)
            ->join('product_spec_areas', 'products.id', '=', 'product_spec_areas.product_id')
            ->join('speciality_areas', 'product_spec_areas.spec_area_id', '=', 'speciality_areas.id')
            
            // ---- FIN DE LA CORRECCIÓN ----
            
            // 3. Filtrar solo productos activos
            ->where('products.active', '=', 1)

            // 4. Agrupar la lógica de búsqueda (OR)
            ->where(function($q) use ($searchTermLike) {
                // Forzamos la comparación en minúsculas
                $q->where(DB::raw('LOWER(products.name)'), 'LIKE', $searchTermLike)
                  ->orWhere(DB::raw('LOWER(categories.name)'), 'LIKE', $searchTermLike)
                  ->orWhere(DB::raw('LOWER(speciality_areas.name)'), 'LIKE', $searchTermLike);
            });
            
            // 5. Aplicar filtros adicionales (si existen)
            if (!empty($appliedFilters)) {
                $categories = collect($appliedFilters)->flatten()->unique()->toArray();
                
                // Ahora podemos filtrar directamente sobre el JOIN
                // en lugar de usar un 'whereHas'
                $query->whereIn('categories.name', $categories);
            }

            // 6. Seleccionar 'products.*' y usar 'distinct'
            return $query->select('products.*')
                         ->distinct()
                         ->orderBy('products.name')
                         ->get();

        } catch (Exception $e) {
            Log::error('Error al obtener producto por búsqueda: ' . $e->getMessage());
            return collect(); // Devolver una colección vacía en caso de error
        }
    }

    /**
     * Obtiene los PDFs de accesorios.
     */
    public function getAccesoryPdfs() 
    {
        try {
            $accesorypdfs = AccesoryPdf::orderBy('name')->get();
            return $accesorypdfs;
        } catch (Exception $e) {
            Log::error('Error al obtener pdf de accesorios: ' . $e->getMessage());
            return collect(); 
        }
    }

}
