<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;
use Illuminate\View\Component;
use Exception;

use Log;
class ServiceContactController extends Controller
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
            ['name' => 'Contáctenos', 'to' => '/contacto'],
        ];
        return view('service-contact',compact('pages'));
    }
    
    public function showByService($specialty)
    {
    
        $specialty_name = $specialty;
        $services = $this->getServices();
        $pages = [
            ['name' => 'Nosotros', 'to' => '/about'],
            ['name' => 'Alianzas', 'to' => '/alliances'],
            ['name' => 'Catálogo', 'to' => '/catalogs'],
            ['name' => 'Servicios', 'sublinks' => [
                ['name' => 'Instalación y Re-instalación',          'to' => '/services'],
                ['name' => 'Mantenimiento correctivo y preventivo', 'to' => '/services']
                ]],
            ['name' => 'Contáctenos', 'to' => '/contacto'],
        ];
        return view('service-contact',compact('pages' ,'specialty_name', 'services'));
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



}
