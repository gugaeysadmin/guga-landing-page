<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $brands = Brand::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'data' => $brands
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener marcas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las marcas'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Calcular el próximo índice (máximo actual + 1)
        // // Guardar la imagen

        $imagePath = $request->file('image')->store('brands', 'public');

        
        $brand = Brand::create([
            'name' => $request['title'],
            'description' => $request['details'],
            'logo_file_url' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Marca creada exitosamente',
            'data' => $brand
        ], 201);
    }

    public function onlyname(Request $request)
    {

        
        $brand = Brand::create([
            'name' => $request['name'],
        ]);

        return response()->json([
            'message' => 'Marca creada exitosamente',
            'data' => $brand
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $brand
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener marca: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100',
                'details' => 'nullable|string',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $brand->name = $validated['title'];
            }
            if (isset($validated['details'])) {
                $brand->description = $validated['details'];
            }

            
            // Manejar la imagen si se proporciona
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($brand->logo_file_url) {
                    Storage::disk('public')->delete($brand->logo_file_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug($validated['title'] ?? $brand->name).'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('brands', $imageName, 'public');
                $brand->logo_file_url = $imagePath;
            }
            
            
            $brand->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Marca actualizada exitosamente',
                'data' => $brand
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al actualizar marca: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la marca'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $offert = Brand::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($offert->logo_file_url) {
                Storage::disk('public')->delete($offert->logo_file_url);
            }
            
            $offert->delete();
            
            // Reordenar los índices restantes
            
            return response()->json([
                'success' => true,
                'message' => 'Marcas eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar marca: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la marca'
            ], 500);
        }
    }
}
