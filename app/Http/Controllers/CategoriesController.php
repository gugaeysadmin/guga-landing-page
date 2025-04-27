<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Exception;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Categories::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener categoria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las categorias'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // // Guardar la imagen
        $category = Categories::create([
            'name' => $request['title'],
        ]);

        return response()->json([
            'message' => 'Categoria creada exitosamente',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = Categories::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener categorias: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Categoria no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = Categories::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100'
            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $category->name = $validated['title'];
            }
            
            $category->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Categoria actualizada exitosamente',
                'data' => $category
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al actualizar categoria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoria'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Categories::findOrFail($id);
            
            $category->delete();
            
            // Reordenar los índices restantes
            
            return response()->json([
                'success' => true,
                'message' => 'Categoria eliminada exitosamente'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al eliminar categoria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la categoria'
            ], 500);
        }
    }
}
