<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use App\Models\AccesoryPdf;
use App\Models\Brand;
use App\Models\LandingPageConfig;
use App\Models\Product;
use App\Models\SpecialityArea;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\View\Component;
use Exception;
use Log;
class CatalogsController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index(Request $request)
    {
        $appliedFilters = $request->input('filter', []);
        $pages = [
            ['name' => 'Nosotros', 'to' => '/about'],
            ['name' => 'Alianzas', 'to' => '/alliances'],
            ['name' => 'Catálogo', 'to' => '/catalogs'],
            ['name' => 'Servicios', 'sublinks' => [
                ['name' => 'Instalación y Re-instalación',          'to' => '/services'],
                ['name' => 'Mantenimiento correctivo y preventivo', 'to' => '/services']
                ]],
            ['name' => 'Contáctenos', 'to' => '/contact'],
        ];

        $brandsFilters = (object) [
            'section' => 'Marcas', 
            'categories' => $this->getBrands()
        ];

        // $specAreaFilters = (object) [
        //     'section' => 'Áreas de ecpecialidad', 
        //     'categories' => $this->getSpecAreas()
        // ];

        $specareas = $this->getSpecAreas();

        
        $filters = $this->getEnterpriseInformation();
        if($filters == null){
            $filters = [];
        }

        array_unshift($filters, $brandsFilters);

        
        $accesoryPdf = $this->getAccesoryPdfs();
        $query =  Product::with([
            'brand:id,name',
            'category:id,name',
            'productSpecAreas.specArea:id,name',
            'productSpecAreas' => function($query) {
                $query->orderBy('index'); 
            },
            'productImages:id,product_id,url,type,index,active'
        ]);
        if (!empty($appliedFilters)) {
            foreach ($appliedFilters as $section => $values) {
                switch ($section) {
                    case 'Marcas':
                        $query->whereHas('brand', function($q) use ($values) {
                            $q->whereIn('name', $values);
                        });
                        break;
                        
                    case 'Áreas de ecpecialidad': // Por si hay typo
                        $query->whereHas('productSpecAreas.specArea', function($q) use ($values) {
                            $q->whereIn('name', $values);
                        });
                        $filters = $this->getFilters($values);
                        array_unshift($filters, $brandsFilters);
                        break;
                        
                    default: // Para las categorías de productos
                        $query->whereHas('category', function($q) use ($section, $values) {
                            // Algunas categorías pueden venir con espacios extras
                            $cleanSection = trim($section);
                            $q->whereIn('name', $values);
                        });
                        break;
                }
            }
        }


        $products = $query->paginate(20);
        return view('catalogs',compact('pages', 'products', 'filters' , 'accesoryPdf', 'specareas'));
    }
    

    public function getEnterpriseInformation(){
        try {
            $lpconfig = LandingPageConfig::findOrFail(1);
            return json_decode($lpconfig->catalogs_filters);
        } catch (Exception $e) {
            Log::error('Error al obtener la configuración de la página: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la configuración de la página'
            ], 404);
        }
    }

    public function getSpecAreas(){
        // try {
        //     $speca = SpecialityArea::orderBy('index')->pluck('name')->toArray();
        //     return $speca;
        // } catch (Exception $e) {
        //     Log::error('Error al obtener spec area: ' . $e->getMessage());
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error al obtener las spec areas'
        //     ], 500);
        // }

        try {
            $speca = SpecialityArea::orderBy('index')->get();
            return $speca;
        } catch (Exception $e) {
            Log::error('Error al obtener specareas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las specareas'
            ], status: 500);
        }
    }

    public function getBrands()
    {
        try {
            $brands = Brand::orderBy('name')->pluck('name')->toArray();
            
            return $brands;
        } catch (Exception $e) {
            Log::error('Error al obtener marcas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las marcas'
            ], 500);
        }
    }

    public function getAccesoryPdfs() {

        try {
            $accesorypdfs = AccesoryPdf::orderBy('name')->get();
            
            return $accesorypdfs;
        } catch (Exception $e) {
            Log::error('Error al obtener pdf de accesorios: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los accesorios del pdf'
            ], 500);
        }
    }

    public function getFilters($speciality){
        try {
            $specarea = SpecialityArea::where("name", "=", $speciality)->firstOrFail();
            
            $filters = json_decode($specarea->filters);
            return $filters;
        } catch (Exception $e) {
            Log::error('Error al obtener área de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oferta no encontrada'
            ], 404);
        }
    }


}
