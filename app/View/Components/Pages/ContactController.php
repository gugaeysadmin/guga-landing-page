<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;
use App\Models\LandingPageConfig;
use Exception;
use Log;
class ContactController extends Controller
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

        $entepriseInfo = $this->getEnterpriseInformation();


        return view('contact',compact('pages', 'entepriseInfo'));
    }

    public function getEnterpriseInformation(){
        try {
            $lpconfig = LandingPageConfig::findOrFail(1);
            return $lpconfig;
        } catch (Exception $e) {
            Log::error('Error al obtener la configuración de la página: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la configuración de la página'
            ], 404);
        }
    }
}
