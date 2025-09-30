<?php

namespace App\Http\Controllers;

use App\Models\AccesoryPdf;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;


class AccesoryPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $accesorypdfs = AccesoryPdf::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'data' => $accesorypdfs
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener pdf de accesorios: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los accesorios del pdf'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // // Guardar la imagen
        $imagePath = $request->file('image')->store('accesorypdfs', 'public');

        
        $specarea = AccesoryPdf::create([
            'name' => $request['title'],
            'pdf_url' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Accesorio creada exitosamente',
            'data' => $specarea
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $specarea = AccesoryPdf::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $specarea
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener pdf del accesorio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Pdf del accesorio no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specarea = AccesoryPdf::findOrFail($id);

        // Si hay un archivo nuevo
        if ($request->hasFile('image')) {
            // Eliminar el archivo anterior si existe
            if ($specarea->pdf_url && \Storage::disk('public')->exists($specarea->pdf_url)) {
                \Storage::disk('public')->delete($specarea->pdf_url);
            }

            // Guardar el nuevo archivo
            $imagePath = $request->file('image')->store('accesorypdfs', 'public');
            $specarea->pdf_url = $imagePath;
        }

        // Actualizar el nombre si viene en la request
        if ($request->filled('title') && $request['title']  !== null && $request['title'] !== 'null') {
            $specarea->name = $request['title'];
        }

        $specarea->save();

        return response()->json([
            'message' => 'Accesorio actualizado exitosamente',
            'data' => $specarea
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $specarea = AccesoryPdf::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($specarea->pdf_url) {
                Storage::disk('public')->delete($specarea->pdf_url);
            }
            
            $specarea->delete();
            
            // Reordenar los índices restantes
            
            return response()->json([
                'success' => true,
                'message' => 'Pdf de accesorio eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar Pdf de accesorio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el Pdf de accesorio'
            ], 500);
        }
    }
}
