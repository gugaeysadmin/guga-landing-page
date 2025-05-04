<?php

namespace App\Http\Controllers;

use App\Models\Offert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class OffertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $offerts = Offert::orderBy('index')->get();
            
            return response()->json([
                'success' => true,
                'data' => $offerts
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener ofertas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las ofertas'
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
        $nextIndex = (Offert::max('index') ?? 0) + 1;

        // // Guardar la imagen
        $imagePath = $request->file('image')->store('offerts', 'public');

        
        $offert = Offert::create([
            'name' => $request['title'],
            'description' => $request['details'],
            'img_url' => $imagePath,
            'active' => $request['active'] ? 1 : 0,
            'index' => $nextIndex
        ]);

        return response()->json([
            'message' => 'Oferta creada exitosamente',
            'data' => $offert
        ], 201);

        // return response()->json(['message'=> 'eeee'], 201);
    }

    public function reorderIndexes()
    {
        $offerts = Offert::orderBy('index')->get();
        
        foreach ($offerts as $index => $offert) {
            $offert->update(['index' => $index + 1]);
        }
        
        return response()->json(['message' => 'Índices reordenados']);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:offerts,id',
            'updates.*.index' => 'required|integer|min:1'
        ]);
        
        try {
            DB::beginTransaction();
            
            foreach ($request->updates as $update) {
                Offert::where('id', $update['id'])
                     ->update(['index' => $update['index']]);
            }
            
            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
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
            $offert = Offert::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $offert
            ]);
        } catch (\Exception $e) {
            Log::error('Error al obtener oferta: ' . $e->getMessage());
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
            $offert = Offert::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100',
                'details' => 'nullable|string',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
                'active' => 'sometimes|boolean',
                'index' => 'sometimes|integer'
            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $offert->name = $validated['title'];
            }
            if (isset($validated['details'])) {
                $offert->description = $validated['details'];
            }
            if (isset($validated['active'])) {
                $offert->active = $validated['active'];
            }
            
            // Manejar la imagen si se proporciona
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($offert->img_url) {
                    Storage::disk('public')->delete($offert->img_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug($validated['title'] ?? $offert->name).'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('offerts', $imageName, 'public');
                $offert->img_url = $imagePath;
            }
            
            // Manejar el índice si se proporciona
            if (isset($validated['index'])) {
                $this->reorderOfferts($offert, $validated['index']);
            }
            
            $offert->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Oferta actualizada exitosamente',
                'data' => $offert
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al actualizar oferta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la oferta'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $offert = Offert::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($offert->img_url) {
                Storage::disk('public')->delete($offert->img_url);
            }
            
            $offert->delete();
            
            // Reordenar los índices restantes
            $this->reorderAllOfferts();
            
            return response()->json([
                'success' => true,
                'message' => 'Oferta eliminada exitosamente'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al eliminar oferta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la oferta'
            ], 500);
        }
    }

    /**
     * Reordenar ofertas cuando se cambia el índice de una
     */
    private function reorderOfferts(Offert $movedOffert, $newIndex)
    {
        $currentIndex = $movedOffert->index;
        $maxIndex = Offert::max('index');
        
        // Asegurar que el nuevo índice esté dentro de los límites
        $newIndex = max(1, min($newIndex, $maxIndex));
        
        if ($newIndex > $currentIndex) {
            // Mover hacia abajo en la lista
            Offert::where('index', '>', $currentIndex)
                  ->where('index', '<=', $newIndex)
                  ->decrement('index');
        } elseif ($newIndex < $currentIndex) {
            // Mover hacia arriba en la lista
            Offert::where('index', '>=', $newIndex)
                  ->where('index', '<', $currentIndex)
                  ->increment('index');
        }
        
        $movedOffert->index = $newIndex;
    }

    /**
     * Reordenar todas las ofertas (después de eliminar)
     */
    private function reorderAllOfferts()
    {
        $offerts = Offert::orderBy('index')->get();
        
        foreach ($offerts as $index => $offert) {
            $offert->index = $index + 1;
            $offert->save();
        }
    }
}
