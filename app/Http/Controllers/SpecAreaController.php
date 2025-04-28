<?php

namespace App\Http\Controllers;

use App\Models\SpecialityArea;
use Exception;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class SpecAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $speca = SpecialityArea::orderBy('index')->get();
            
            return response()->json([
                'success' => true,
                'data' => $speca
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
        // $validated = $request->validate([
        //     'title' => 'required|string|max:100',
        //     'details' => 'nullable|string',
        //     // 'image' => 'required|image|mimes:jpeg,png|max:500',
        //     'active' => 'boolean'
        // ]);

        // // Calcular el próximo índice (máximo actual + 1)
        $nextIndex = (SpecialityArea::max('index') ?? 0) + 1;

        // // Guardar la imagen
        $imagePath = $request->file('image')->store('specarea', 'public');

        
        $specarea = SpecialityArea::create([
            'name' => $request['title'],
            'description' => $request['details'],
            'icon_file_url' => $imagePath,
            // 'active' => $request['active'] ? 1 : 0,
            'index' => $nextIndex
        ]);

        return response()->json([
            'message' => 'Area de especialidad creada exitosamente',
            'data' => $specarea
        ], 201);

        // return response()->json(['message'=> 'eeee'], 201);
    }

    public function reorderIndexes()
    {
        $specareas = SpecialityArea::orderBy('index')->get();
        
        foreach ($specareas as $index => $specarea) {
            $specarea->update(['index' => $index + 1]);
        }
        
        return response()->json(['message' => 'Índices reordenados']);
    }

    public function reorder(Request $request)
    {
        Log::info($request);
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:speciality_areas,id',
            'updates.*.index' => 'required|integer|min:1'
        ]);
        
        try {
            DB::beginTransaction();
            
            foreach ($request->updates as $update) {
                SpecialityArea::where('id', $update['id'])
                     ->update(['index' => $update['index']]);
            }
            
            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $specarea = SpecialityArea::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $specarea
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener área de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oferta no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $specarea = SpecialityArea::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100',
                'details' => 'nullable|string',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
                'index' => 'sometimes|integer'
            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $specarea->name = $validated['title'];
            }
            if (isset($validated['details'])) {
                $specarea->description = $validated['details'];
            }
            // Manejar la imagen si se proporciona
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($specarea->icon_file_url) {
                    Storage::disk('public')->delete($specarea->icon_file_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug($validated['title'] ?? $specarea->name).'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('specarea', $imageName, 'public');
                $specarea->icon_file_url = $imagePath;
            }
            
            // Manejar el índice si se proporciona
            if (isset($validated['index'])) {
                $this->reorderSpecAreas($specarea, $validated['index']);
            }
            
            $specarea->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Oferta actualizada exitosamente',
                'data' => $specarea
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al actualizar área de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la área de especialidad'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $specarea = SpecialityArea::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($specarea->img_url) {
                Storage::disk('public')->delete($specarea->img_url);
            }
            
            $specarea->delete();
            
            // Reordenar los índices restantes
            $this->reorderAllSpecAreas();
            
            return response()->json([
                'success' => true,
                'message' => 'área de especialidad eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar área de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la área de especialidad'
            ], 500);
        }
    }

    /**
     * Reordenar áreas de especialidad cuando se cambia el índice de una
     */
    private function reorderSpecAreas(SpecialityArea $movedOffert, $newIndex)
    {
        $currentIndex = $movedOffert->index;
        $maxIndex = SpecialityArea::max('index');
        
        // Asegurar que el nuevo índice esté dentro de los límites
        $newIndex = max(1, min($newIndex, $maxIndex));
        
        if ($newIndex > $currentIndex) {
            // Mover hacia abajo en la lista
            SpecialityArea::where('index', '>', $currentIndex)
                  ->where('index', '<=', $newIndex)
                  ->decrement('index');
        } elseif ($newIndex < $currentIndex) {
            // Mover hacia arriba en la lista
            SpecialityArea::where('index', '>=', $newIndex)
                  ->where('index', '<', $currentIndex)
                  ->increment('index');
        }
        
        $movedOffert->index = $newIndex;
    }

    /**
     * Reordenar todas las áreas de especialidad (después de eliminar)
     */
    private function reorderAllSpecAreas()
    {
        $specareas = SpecialityArea::orderBy('index')->get();
        
        foreach ($specareas as $index => $specarea) {
            $specarea->index = $index + 1;
            $specarea->save();
        }
    }
}
