<?php

namespace App\View\Components\Pages;

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
            ['name' => 'Nosotros', 'to' => '/about'],
            ['name' => 'Alianzas', 'to' => '/alliances'],
            ['name' => 'Catálogo', 'to' => '/catalogs'],
            ['name' => 'Servicios', 'sublinks' => [
                ['name' => 'Instalación y Re-instalación',          'to' => '/services'],
                ['name' => 'Mantenimiento correctivo y preventivo', 'to' => '/services']
                ]],
            ['name' => 'Contáctenos', 'to' => '/contact'],
        ];
        $aliances = [
            ['image' => asset('img/amtai.png'),     'to' => 'https://www.amtai.com'],
            ['image' => asset('img/biobase.png'),   'to' => 'https://www.biobase.cc/'],
            ['image' => asset('img/cisa.png'),      'to' => 'https://www.cisabrasile.com.br/es/?lang=es'],
            ['image' => asset('img/biodex.jpg'),    'to' => 'https://www.biodex.com/'],
            ['image' => asset('img/fiochetti.jpg'), 'to' => 'https://www.fiocchetti.it/en/'],
            ['image' => asset('img/genoray.png'),   'to' => 'https://www.genoray.com/?ckattempt=1'],
            ['image' => asset('img/guerbet.png'),   'to' => 'https://www.guerbet.com/es-mx'],
            ['image' => asset('img/lf.jpg'),        'to' => 'https://www.linkedin.com/company/liebel-flarsheim-company-llc'],

        ];

        $areas =[
            ['title' => 'Esterilización', 'image' => asset('img/esterilizador.png'),    'equipments'=> ['Autoclaves','Indicadores biológicos','Indicadores químicos']],
            ['title' => 'Quirófano',      'image' => asset('img/mesa.png'),             'equipments'=> ['Mesas de cirugía','Luces de cirugía LED']],
            ['title' => 'Imagenología',   'image' => asset('img/acrc.png'),             'equipments'=> ['Brazo en C','Tomosíntesis Mamaria Digital']],
            ['title' => 'Refrigeración',  'image' => asset('img/refri.png'),            'equipments'=> ['Refrigeradores','Congeladores'.'Almacenamiento de sangre']],
        ];

        $services = [
            ['image' => asset('img/1.png'), 'to' => ''],
            ['image' => asset('img/2.png'), 'to' => ''],
            ['image' => asset('img/3.png'), 'to' => ''],
        ];
        
        return view('welcome', compact('imagelist', 'pages', 'aliances', 'areas','services'));
    }
}
