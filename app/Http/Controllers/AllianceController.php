<?php

namespace App\Http\Controllers;

use App\Models\Alliance;
use Exception;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AllianceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $alliances = Alliance::orderBy('index')->get();
            
            return response()->json([
                'success' => true,
                'data' => $alliances
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener alianzas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las alianzas'
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
        $nextIndex = (Alliance::max('index') ?? 0) + 1;

        // // Guardar la imagen
        $imagePath = $request->file('image')->store('alliances', 'public');

        
        $alliances = Alliance::create([
            'name' => $request['title'],
            'description' => $request['details'],
            'img_url' => $imagePath,
            'externalImage'=> $request['url'],
            'active' => $request['active'] ? 1 : 0,
            'index' => $nextIndex
        ]);

        return response()->json([
            'message' => 'Alianza creada exitosamente',
            'data' => $alliances
        ], 201);

        // return response()->json(['message'=> 'eeee'], 201);
    }

    public function reorderIndexes()
    {
        $alliances = Alliance::orderBy('index')->get();
        
        foreach ($alliances as $index => $alliance) {
            $alliance->update(['index' => $index + 1]);
        }
        
        return response()->json(['message' => 'Índices reordenados']);
    }

    public function reorder(Request $request)
    {
        Log::info($request);
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:offerts,id',
            'updates.*.index' => 'required|integer|min:1'
        ]);
        
        try {
            DB::beginTransaction();
            
            foreach ($request->updates as $update) {
                Alliance::where('id', $update['id'])
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
            $offert = Alliance::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $offert
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener alianza: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Alianza no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $alliance = Alliance::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100',
                'details' => 'nullable|string',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
                'active' => 'sometimes|boolean',
                'index' => 'sometimes|integer',
                'url'=> 'nullable|string',

            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $alliance->name = $validated['title'];
            }

            if (isset($validated['details'])) {
                $alliance->description = $validated['details'];
            }

            if (isset($validated['active'])) {
                $alliance->active = $validated['active'];
            }

            if (isset($validated['url'])) {
                $alliance->externalImage = $validated['url'];
            }
            
            // Manejar la imagen si se proporciona
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($alliance->img_url) {
                    Storage::disk('public')->delete($alliance->img_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug($validated['title'] ?? $alliance->name).'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('alliances', $imageName, 'public');
                $alliance->img_url = $imagePath;
            }
            
            // Manejar el índice si se proporciona
            if (isset($validated['index'])) {
                $this->reorderAlliances($alliance, $validated['index']);
            }
            
            $alliance->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Alianza actualizada exitosamente',
                'data' => $alliance
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al actualizar alianza: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la alianza'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $alliance = Alliance::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($alliance->img_url) {
                Storage::disk('public')->delete($alliance->img_url);
            }
            
            $alliance->delete();
            
            // Reordenar los índices restantes
            $this->reorderAllAlliances();
            
            return response()->json([
                'success' => true,
                'message' => 'Alianza eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar alianza: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la alianza'
            ], 500);
        }
    }

    /**
     * Reordenar ofertas cuando se cambia el índice de una
     */
    private function reorderAlliances(Alliance $movedAlliance, $newIndex)
    {
        $currentIndex = $movedAlliance->index;
        $maxIndex = Alliance::max('index');
        
        // Asegurar que el nuevo índice esté dentro de los límites
        $newIndex = max(1, min($newIndex, $maxIndex));
        
        if ($newIndex > $currentIndex) {
            // Mover hacia abajo en la lista
            Alliance::where('index', '>', $currentIndex)
                  ->where('index', '<=', $newIndex)
                  ->decrement('index');
        } elseif ($newIndex < $currentIndex) {
            // Mover hacia arriba en la lista
            Alliance::where('index', '>=', $newIndex)
                  ->where('index', '<', $currentIndex)
                  ->increment('index');
        }
        
        $movedAlliance->index = $newIndex;
    }

    /**
     * Reordenar todas las ofertas (después de eliminar)
     */
    private function reorderAllAlliances()
    {
        $alliances = Alliance::orderBy('index')->get();
        
        foreach ($alliances as $index => $offert) {
            $alliances->index = $index + 1;
            $alliances->save();
        }
    }
}
