<?php

namespace App\Http\Controllers;

use App\Models\CatalogSections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Exception;


class CatalogCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = CatalogSections::orderBy('section_name')->get();
            
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener las secciones de catalogos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las secciones de catalogos'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = CatalogSections::create([
            'section_name' => $request['title'],
        ]);

        return response()->json([
            'message' => 'Seccion de catalogos creada exitosamente',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = CatalogSections::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener las secciones de los catalogos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Seccion de catalogo no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = CatalogSections::findOrFail($id);
            
            $category->delete();
            
            // Reordenar los índices restantes
            
            return response()->json([
                'success' => true,
                'message' => 'Seccion del catalogo eliminado exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar la seccion del catalogo: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la seccion del catálogo'
            ], 500);
        }
    }
}
