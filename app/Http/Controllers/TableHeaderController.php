<?php

namespace App\Http\Controllers;

use App\Models\ProductTableConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Exception;

class TableHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $thconf = ProductTableConfiguration::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'data' => $thconf
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener conf de las tablas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener conf de las tablas'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $thconf = ProductTableConfiguration::create([
            'name' => $request['name'],
            'table_json' => $request['table_json'],
        ]);

        return response()->json([
            'message' => 'conf de las tablas creada exitosamente',
            'data' => $thconf
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $thconf = ProductTableConfiguration::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $thconf
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener conf de las tablas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Conf de las tablas no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $thconf = ProductTableConfiguration::findOrFail($id);

        // Actualizar solo los campos que vengan en la request
        if ($request->filled('name')) {
            $thconf->name = $request->input('name');
        }

        if ($request->filled('table_json')) {
            $thconf->table_json = $request->input('table_json');
        }

        $thconf->save();

        return response()->json([
            'message' => 'Configuración de tabla actualizada exitosamente',
            'data' => $thconf
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tableConf = ProductTableConfiguration::findOrFail($id);
            
            $tableConf->delete();
            
            // Reordenar los índices restantes
            
            return response()->json([
                'success' => true,
                'message' => 'Conf de las tablas eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar Conf de las tablas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la Conf de las tablas'
            ], 500);
        }
    }
}
