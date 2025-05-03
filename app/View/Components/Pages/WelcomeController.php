<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use App\Models\Alliance;
use App\Models\LandingPageConfig;
use App\Models\Service;
use App\Models\SpecialityArea;
use Exception;
use Illuminate\View\View;
use Illuminate\View\Component;
use Log;

class WelcomeController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index()
    {
        $imagelist  = [
            ['image' => asset('img/img1.jpg'), 'description' => 'imagen 1'],
            ['image' => asset('img/img2.jpg'), 'description' => 'imagen 2'],
            ['image' => asset('img/img3.jpg'), 'description' => 'imagen 3'],
            ['image' => asset('img/img4.jpg'), 'description' => 'imagen 4'],
        ];
        // $pages = [
        //     ['name' => 'Nosotros', 'to' => '/about'],
        //     ['name' => 'Catálogo', 'to' => '/catalogs'],
        //     ['name' => 'Alianzas', 'to' => '/services'],
        //     ['name' => 'Servicios', 'sublinks' => [
        //         ['name' => 'Instalación y Re-instalación',          'to' => '/services'],
        //         ['name' => 'Mantenimiento correctivo y preventivo', 'to' => '/services']
        //         ]],
        //     ['name' => 'Contáctenos', 'to' => '/contact'],
        // ];
        $alliances = $this->getAlliancees();

        $areas = $this->getSpecAreas();

        $entepriseInfo = $this->getEnterpriseInformation();

        $services = $this->getServices();


        $offerts = [
            ['id'=> 1, 'title'=> 'Silla de transporte no magnética', 'description' => 'Descripcion de la oferta 1', 'url'=>'offerts/1EuzCOmQSPkpYbUFlMEDggPnJyZeU9wHB1zeUvqr.jpg'],
            ['id'=> 2, 'title'=> 'Jeringa CT 9000', 'description' => 'Descripcion de la oferta 2', 'url'=>'offerts/cx5rlibsdrIpztGTya6GrxVbNRfw3asvWWbq4qYO.jpg'],
            ['id'=> 3, 'title'=> 'Esterilizador de mesa', 'description' => 'Descripcion de la oferta 3', 'url'=>'offerts/mZJaIkoLDyxng3f26jTPXKu2qZVS0KsacouCyaxT.jpg'],
            ['id'=> 4, 'title'=> 'OPTIRAY 350/50', 'description' => 'Descripcion de la oferta 4', 'url'=>'offerts/dQQLp6Rf9ySdPU9uTyklxcwEq3QPgc9ww5P1lzJI.jpg'],
            ['id'=> 5, 'title'=> 'CALENTADOR DE MEDIO DE CONTRASTE', 'description' => 'Descripcion de la oferta 5', 'url'=>'offerts/lF9V17WSBHLg9iuBmVWYM0iednCZdXdU6LETzvyG.jpg'],

        ];
        
        return view('welcome', compact('imagelist', 'alliances', 'areas','services','offerts','entepriseInfo'));
    }

    public function getSpecAreas(){
        try {
            $speca = SpecialityArea::orderBy('index')->get();
            return $speca;
        } catch (Exception $e) {
            Log::error('Error al obtener categoria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las categorias'
            ], 500);
        }
    }

    public function getEnterpriseInformation(){
        try {
            $lpconfig = LandingPageConfig::findOrFail(1);
            return $lpconfig;
        } catch (Exception $e) {
            Log::error('Error al obtener la configuracion de la página: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la configuracion de la página'
            ], 404);
        }
    }

    public function getServices(){
        try {
            $services = Service::orderBy('index')->get();
            
            return $services;
        } catch (Exception $e) {
            Log::error('Error al obtener servicio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener servicios'
            ], 500);
        }
    }

    public function getAlliancees() {
        try {
            $alliances = Alliance::where('active','=',1)->orderBy('index')->get();
            Log::info($alliances);
            return $alliances;
        } catch (Exception $e) {
            Log::error('Error al obtener alianzas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las alianzas'
            ], 500);
        }
    
    }
}