<?php

namespace App\View\Components;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

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
        $pages = [
            ['name' => 'Nosotros', 'to' => 'to'],
            ['name' => 'Alianzas', 'to' => 'to'],
            ['name' => 'Catálogo', 'to' => 'to'],
            ['name' => 'Servicios', 'sublinks' => [
                ['name' => 'Instalación y Re-instalación', 'to' => 'to1'],
                ['name' => 'Mantenimiento correctivo y preventivo', 'to' => 'to2']
                ]],
            ['name' => 'Contáctenos', 'to' => 'to'],
        ];
        $aliances = [
            ['image' => asset('img/amtai.png'), 'to' => 'https://www.amtai.com'],
            ['image' => asset('img/biobase.png'), 'to' => 'https://www.biobase.cc/'],
            ['image' => asset('img/cisa.png'),'to' => 'https://www.cisabrasile.com.br/es/?lang=es'],
            ['image' => asset('img/biodex.jpg'),'to' => 'https://www.biodex.com/'],
            ['image' => asset('img/fiochetti.jpg'),'to' => 'https://www.fiocchetti.it/en/'],
            ['image' => asset('img/genoray.png'),'to' => 'https://www.genoray.com/?ckattempt=1'],
            ['image' => asset('img/guerbet.png'),'to' => 'https://www.guerbet.com/es-mx'],
            ['image' => asset('img/lf.jpg'),'to' => 'https://www.linkedin.com/company/liebel-flarsheim-company-llc'],

        ];
        
        return view('welcome', compact('imagelist', 'pages','aliances'));
    }
}
