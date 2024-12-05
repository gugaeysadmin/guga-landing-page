<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

class AlliancesController extends Controller
{
    /**
     * Get the view / contents that represents the component.
     */
    public function index()
    {
        $pages = [
            ['name' => 'Nosotros', 'to' => 'welecome'],
            ['name' => 'Alianzas', 'to' => 'alliances'],
            ['name' => 'Catálogo', 'to' => 'catalogs'],
            ['name' => 'Servicios', 'sublinks' => [
                ['name' => 'Instalación y Re-instalación',          'to' => 'services'],
                ['name' => 'Mantenimiento correctivo y preventivo', 'to' => 'services']
                ]],
            ['name' => 'Contáctenos', 'to' => 'contact'],
        ];
        return view('alliances');
    }
}
