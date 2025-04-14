<?php

namespace App\View\Components\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\View\Component;

class SpecialityAreaController extends Controller
{


    public function showBySpecialty($specialty)
    {
        // Lógica para manejar la especialidad
        // Por ejemplo, buscar información en la base de datos:
        $data = [
            'refrigeration' => 'Refrigeración',
            'sterilization' => 'sterilización',
            'operating-room' => 'Quirófano',
            'imageneology' => 'Imageneologia'
        ];

        $contentData = [
            ['name'=> 'priducto 1', 'img' => 'https://pagedone.io/asset/uploads/1700471851.png'],
            ['name'=> 'priducto 2', 'img' => 'https://pagedone.io/asset/uploads/1711514857.png'],
            ['name'=> 'priducto 3', 'img' => 'https://pagedone.io/asset/uploads/1711514875.png'],
            ['name'=> 'priducto 4', 'img' => 'https://pagedone.io/asset/uploads/1711514892.png'],
            ['name'=> 'priducto 5', 'img' => 'https://pagedone.io/asset/uploads/1711514857.png'],
            ['name'=> 'priducto 6', 'img' => 'https://pagedone.io/asset/uploads/1711514875.png'],
        ];
        
        $filters = [
            ['name' => 'Farmacia y Vacunas', 'tag' => 'FYV', 'subcategories' => [
                ['name' => 'Refrigeradores puerta vidrio', 'tag' => 'RFPDB', 'PARENT' => 'FYV' ],
                ['name' => 'Refrigeradores puerta solida', 'tag' => 'RFDPS', 'PARENT' => 'FYV' ],
                ['name' => 'Refrigeradores combinados (Refrigerador/Congelador)', 'tag' => 'RCRC', 'PARENT' => 'FYV' ],
            ]],
            ['name' => 'Transfusión de bancos de sangre y congeladores de plasma', 'tag' => 'TDBDSYC', 'subcategories' => [
                ['name' => 'Bancos de sangre +4ºC', 'tag' => 'BDS4C', 'PARENT' => 'TDBDSYC' ],
                ['name' => 'Congeladores de plasma', 'tag' => 'CDP', 'PARENT' => 'TDBDSYC' ],
                ['name' => 'Refrigeradores para banco de sangre y plasma combinados', 'tag' => 'RPBDSYPC', 'PARENT' => 'TDBDSYC'],
            ]],
            ['name' => 'Hospital, médico y laboratorio', 'tag' => 'HMYL', 'subcategories' => [
                ['name' => 'Congeladores puerta solida ', 'tag' => 'CPS', 'PARENT' => 'HMYL' ],
                ['name' => 'Refrigeradores / congeladores combinados', 'tag' => 'CISA', 'PARENT' => 'HMYL' ],
                ['name' => 'Congeladores puerta de vidrio', 'tag' => 'CPDV', 'PARENT' => 'HMYL' ],
            ]],
            ['name' => 'Científicos e industria ', 'tag' => 'CEI', 'subcategories' => [
                ['name' => 'Refrigerador de cromatografía', 'tag' => 'RDC', 'PARENT' => 'CEI' ],
            ]],
            ['name' => 'Refrigeración de transporte ', 'tag' => 'RDT', 'subcategories' => [
                ['name' => 'Serie C 29 -  65T', 'tag' => 'SC29', 'PARENT' => 'RDT' ]
            ]],

        ];
        if (array_key_exists($specialty, $data)) {
            return view('speciality-area', ['info' => $data[$specialty], 'content'=>$this->getSpecAreaData($specialty), 'filters' => $filters]);
        }


        // Si no se encuentra, puedes redirigir o mostrar un error
        abort(404, 'Especialidad no encontrada');
    }

    public function getSpecAreaData($speciality){
        return [
                    [
                        'name'=> 'priducto 1',
                        'brand'=> 'Marca n',
                        'description' => ' There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.',
                        'img' => [
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 0
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
                                'position' => 1
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 2
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
                                'position' => 3
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
                                'position' => 4
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
                                'position' => 5
                            ]
                        ],
                        'tableHeaders' => ['Capacidad','Rango de temperatura','Controlador','Dimensiones','N Repizas','PDF'],
                        'table' => [
                            [
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 2,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "1",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 3,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "2",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 4,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "3",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 5,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "4",
                                "PDF" => "pdflink"
                            ]
                        ],
                    ],
                    [
                        'name'=> 'priducto 2',
                        'brand'=> 'Marca n',
                        'description' => 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
                        'img' => [
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 0
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
                                'position' => 1
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 2
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
                                'position' => 3
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
                                'position' => 4
                            ]
                        ],
                        'tableHeaders' => ['Capacidad','Rango de temperatura','img','Controlador','Dimensiones','N Repizas','PDF'],
                        'table' => [
                            [
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 4,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "3",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 3,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "4",
                                "PDF" => "pdflink"
                            ]
                        ],
                    ],
                    [
                        'name'=> 'priducto 3',
                        'brand'=> 'Marca n',
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
                        'img' => [
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 0
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
                                'position' => 1
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
                                'position' => 2
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
                                'position' => 3
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
                                'position' => 4
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
                                'position' => 5
                            ],
                            [
                                'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
                                'position' => 6
                            ],
                        ],
                        'tableHeaders' => ['Capacidad','Rango de temperatura','img','Controlador','Dimensiones','N Repizas','PDF'],
                        'table' => [
                            [
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 0,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "1",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 5,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "2",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 6,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "3",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 0,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "1",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 5,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "2",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 6,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "3",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 0,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "1",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 5,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "2",
                                "PDF" => "pdflink"
                            ],[
                                'Capacidad' =>"200lts",
                                'Rango de temperatura' => "200-300grados",
                                'img' => 6,
                                'Controlador' => "ControladorN",
                                'Dimensiones' => "200x500x400",
                                'N Repizas' => "3",
                                "PDF" => "pdflink"
                            ]
                        ],
                    ],
        ];

    }

}
