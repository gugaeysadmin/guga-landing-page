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


        // return [
        //             [
        //                 'name'=> 'priducto 1',
        //                 'brand'=> 'Marca n',
        //                 'description' => ' There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.',
        //                 'accespryPdf'=>'accesorypdfs/D8kEESS1MbfZ9AD5gCZHJ0UERQmbXoVnuMvKr9jR.pdf',
        //                 'page_number'=> 22,
        //                 'services_description' => '<div class="services">
        //                                                 <h2>Nuestros Servicios</h2>
                                                        
        //                                                 <div class="service">
        //                                                     <h3><i class="fas fa-laptop-code"></i> Desarrollo Web</h3>
        //                                                     <p>Creación de sitios web profesionales y aplicaciones a medida.</p>
        //                                                     <p>Soluciones adaptadas a tus necesidades con tecnología moderna.</p>
        //                                                     <ul>
        //                                                         <li>Páginas corporativas</li>
        //                                                         <li>Tiendas online</li>
        //                                                         <li>Aplicaciones web</li>
        //                                                     </ul>
        //                                                 </div>

        //                                                 <div class="service">
        //                                                     <h3><i class="fas fa-shield-alt"></i> Seguridad Informática</h3>
        //                                                     <p>Protección de sistemas y datos contra amenazas digitales.</p>
        //                                                     <p>Soluciones completas para mantener tu información segura.</p>
        //                                                     <ul>
        //                                                         <li>Auditorías de seguridad</li>
        //                                                         <li>Protección contra malware</li>
        //                                                         <li>Cifrado de datos</li>
        //                                                     </ul>
        //                                                 </div>

        //                                                 <div class="service">
        //                                                     <h3><i class="fas fa-cloud"></i> Hosting y Cloud</h3>
        //                                                     <p>Servidores confiables y escalables para tu presencia online.</p>
        //                                                     <p>Alojamiento optimizado para máximo rendimiento.</p>
        //                                                     <ul>
        //                                                         <li>Hosting compartido</li>
        //                                                         <li>Servidores VPS</li>
        //                                                         <li>Soluciones cloud</li>
        //                                                     </ul>
        //                                                 </div>

        //                                                 <div class="service">
        //                                                     <h3><i class="fas fa-mobile-alt"></i> Aplicaciones Móviles</h3>
        //                                                     <p>Desarrollo de apps nativas e híbridas para iOS y Android.</p>
        //                                                     <p>Experiencias de usuario fluidas y atractivas.</p>
        //                                                     <ul>
        //                                                         <li>Aplicaciones empresariales</li>
        //                                                         <li>Apps para consumidores</li>
        //                                                         <li>Integración con sistemas</li>
        //                                                     </ul>
        //                                                 </div>
        //                                             </div>',             
        //                 'img' => [
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 0
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
        //                         'position' => 1
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 2
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
        //                         'position' => 3
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
        //                         'position' => 4
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
        //                         'position' => 5
        //                     ]
        //                 ],
        //                 'tableHeaders' => ['Capacidad','Rango de temperatura','Controlador','Dimensiones','N Repizas','PDF'],
        //                 'table' => [
        //                     [
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 2,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "1",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 3,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "2",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 4,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "3",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 5,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "4",
        //                         "PDF" => "pdflink"
        //                     ]
        //                 ],
        //             ],
        //             [
        //                 'name'=> 'priducto 2',
        //                 'brand'=> 'Marca n',
        //                 'description' => 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
        //                 'services_description' => '',
        //                 'accespryPdf'=>'',
        //                 'page_number'=> 0,
        //                 'img' => [
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 0
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
        //                         'position' => 1
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 2
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
        //                         'position' => 3
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
        //                         'position' => 4
        //                     ]
        //                 ],
        //                 'tableHeaders' => ['Capacidad','Rango de temperatura','img','Controlador','Dimensiones','N Repizas','PDF'],
        //                 'table' => [
        //                     [
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 4,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "3",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 3,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "4",
        //                         "PDF" => "pdflink"
        //                     ]
        //                 ],
        //             ],
        //             [
        //                 'name'=> 'priducto 3',
        //                 'brand'=> 'Marca n',
        //                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        //                 'services_description' => '',
        //                 'accespryPdf'=>'',
        //                 'page_number'=> 0,
        //                 'img' => [
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 0
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514857.png',
        //                         'position' => 1
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514875.png',
        //                         'position' => 2
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
        //                         'position' => 3
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
        //                         'position' => 4
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1711514892.png',
        //                         'position' => 5
        //                     ],
        //                     [
        //                         'src' => 'https://pagedone.io/asset/uploads/1700471851.png',
        //                         'position' => 6
        //                     ],
        //                 ],
        //                 'tableHeaders' => ['Capacidad','Rango de temperatura','img','Controlador','Dimensiones','N Repizas','PDF'],
        //                 'table' => [
        //                     [
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 0,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "1",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 5,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "2",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 6,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "3",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 0,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "1",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 5,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "2",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 6,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "3",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 0,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "1",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 5,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "2",
        //                         "PDF" => "pdflink"
        //                     ],[
        //                         'Capacidad' =>"200lts",
        //                         'Rango de temperatura' => "200-300grados",
        //                         'img' => 6,
        //                         'Controlador' => "ControladorN",
        //                         'Dimensiones' => "200x500x400",
        //                         'N Repizas' => "3",
        //                         "PDF" => "pdflink"
        //                     ]
        //                 ],
        //             ],
        // ];

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
