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
            'refrigeration' => 'Información sobre Refrigeración',
            'sterilization' => 'Información sobre Esterilización',
        ];

        if (array_key_exists($specialty, $data)) {
            return view('speciality-area', ['info' => $data[$specialty]]);
        }

        // Si no se encuentra, puedes redirigir o mostrar un error
        abort(404, 'Especialidad no encontrada');
    }

}
