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

        if (array_key_exists($specialty, $data)) {
            return view('speciality-area', ['info' => $data[$specialty], 'content'=>$contentData]);
        }

        // Si no se encuentra, puedes redirigir o mostrar un error
        abort(404, 'Especialidad no encontrada');
    }

}
