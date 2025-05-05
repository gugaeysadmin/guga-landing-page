<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use App\Models\AccesoryPdf;
use App\Models\LandingPageConfig;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\View\Component;
use Exception;
use Log;
class CatalogsController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index()
    {
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
        $filters = $this->getEnterpriseInformation();
        if($filters == null){
            $filters = [];
        }
        
        $accesoryPdf = $this->getAccesoryPdfs();
        $products =  Product::with([
            'brand:id,name',
            'category:id,name',
            'productSpecAreas.specArea:id,name',
            'productSpecAreas' => function($query) {
                $query->orderBy('index'); 
            },
            'productImages:id,product_id,url,type,index,active'
        ])->paginate(20);

        Log::info($products);

        return view('catalogs',compact('pages', 'products', 'filters' , 'accesoryPdf'));
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
