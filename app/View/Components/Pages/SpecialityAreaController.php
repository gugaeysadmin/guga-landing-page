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
class SpecialityAreaController extends Controller
{


    public function showBySpecialty($specialty, Request $request)
    {

        // $data = [
        //     'refrigeration' => 'Refrigeración',
        //     'sterilization' => 'sterilización',
        //     'operating-room' => 'Quirófano',
        //     'imageneology' => 'Imageneologia'
        // ];

        $specareadata = $this->getFilters($specialty);
        $filters = $specareadata['filters'] ?? [];
        if($filters == null){
            $filters = [];
        }
        $video_url = $specareadata['video_url'];

        $content=$this->getSpecAreaData($specialty, $request->input('filter', []));

        $products = json_encode($content);
        $accesoryPdf = $this->getAccesoryPdfs();


        return view('speciality-area', ['info' => $specialty, 'content'=>json_decode($products), 'filters' => $filters, 'video_url'=> $video_url, 'accesoryPdf'=>$accesoryPdf]);
    }

    public function getSpecAreaData($speciality, $appliedFilters = []){

        try {
            $product =  Product::with([
                'brand:id,name',
                'category:id,name',
                'productSpecAreas.specArea:id,name',
                'productSpecAreas' => function($query) {
                    $query->orderBy('index'); // Ordenar las relaciones
                },
                'productImages:id,product_id,url,type,index,active'
            ])
            ->whereHas('productSpecAreas.specArea', function($query) use ($speciality) {
                $query->where('name', $speciality);
            })
            ->join('product_spec_areas', 'products.id', '=', 'product_spec_areas.product_id')
            ->join('speciality_areas', 'product_spec_areas.spec_area_id', '=', 'speciality_areas.id')
            ->where('speciality_areas.name', $speciality)
            ->where('products.active','=',1)
            ->orderBy('product_spec_areas.index');
            if (!empty($appliedFilters)) {
                // Aplanar el array de filtros para obtener solo las categorías específicas
                $categories = collect($appliedFilters)->flatten()->unique()->toArray();
                $product->whereHas('category', function($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            }

            return $product->select('products.*')->get();
        } catch (Exception $e) {
            Log::error('Error al obtener producto: ' . $e->getMessage());
        }

    }

    public function getFilters($speciality){

        try {
            $specarea = SpecialityArea::where("name", "=", $speciality)->firstOrFail();
            
            $filters = [
                "filters"=>json_decode($specarea->filters),
                "video_url" => $specarea->video_url,

            ];
            return $filters;
        } catch (Exception $e) {
            Log::error('Error al obtener área de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oferta no encontrada'
            ], 404);
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

}
