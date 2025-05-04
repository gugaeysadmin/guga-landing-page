<?php

namespace App\Http\Controllers;

use App\Models\ProductSpecArea;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ProductSpecAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $alliances = ProductSpecArea::with([
                'product' => function($query) {
                    $query->select('id', 'name', 'description', 'brand_id')
                        ->with([
                            'brand' => function($q) {
                                $q->select('id', 'name');
                            },
                            'category' => function($q) {
                                $q->select('category_id', 'name');
                            }
                        ]);
                },
                'SpecArea' => function($query) {
                    $query->select('id', 'name');
                },
            ])->orderBy('index')->get();
            
            return response()->json([
                'success' => true,
                'data' => $alliances
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener los productos de las areas de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos de las areas de especialidad'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $offert = ProductSpecArea::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $offert
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener las areas de especialidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'productos de las areas de especialidad no encontradas'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $alliance = ProductSpecArea::findOrFail($id);
            
            $validated = $request->validate([
                'index' => 'sometimes|integer',
            ]);
            
            // Manejar el índice si se proporciona
            if (isset($validated['index'])) {
                $this->reorderProdSpecAreas($alliance, $validated['index']);
            }
            
            $alliance->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Alianza actualizada exitosamente',
                'data' => $alliance
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al actualizar productspecareas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la productspecareas'
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $productSpecArea = ProductSpecArea::findOrFail($id);
            $specareaid = $productSpecArea->spec_area_id;
            $productSpecArea->delete();
            
            // Reordenar los índices restantes
            $this->reorderAllSpecArea($specareaid);
            
            return response()->json([
                'success' => true,
                'message' => 'productspecareas eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar productspecareas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la productspecareas'
            ], 500);
        }
    }

    public function reorderIndexes()
    {
        $alliances = ProductSpecArea::orderBy('index')->get();
        
        foreach ($alliances as $index => $alliance) {
            $alliance->update(['index' => $index + 1]);
        }
        
        return response()->json(['message' => 'Índices reordenados']);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:product_spec_areas,id',
            'updates.*.index' => 'required|integer|min:1'
        ]);
        
        try {
            DB::beginTransaction();

            foreach ($request->updates as $update) {
                ProductSpecArea::where('id','=', $update['id'])
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
     * Reordenar ofertas cuando se cambia el índice de una
     */
    private function reorderProdSpecAreas(ProductSpecArea $movedAlliance, $newIndex)
    {
        $currentIndex = $movedAlliance->index;
        $maxIndex = ProductSpecArea::max('index');
        
        // Asegurar que el nuevo índice esté dentro de los límites
        $newIndex = max(1, min($newIndex, $maxIndex));
        
        if ($newIndex > $currentIndex) {
            // Mover hacia abajo en la lista
            ProductSpecArea::where('index', '>', $currentIndex)
                  ->where('index', '<=', $newIndex)
                  ->decrement('index');
        } elseif ($newIndex < $currentIndex) {
            // Mover hacia arriba en la lista
            ProductSpecArea::where('index', '>=', $newIndex)
                  ->where('index', '<', $currentIndex)
                  ->increment('index');
        }
        
        $movedAlliance->index = $newIndex;
    }

    /**
     * Reordenar todas las ofertas (después de eliminar)
     */
    public function reorderAllSpecArea($specareaId)
    {
        $alliances = ProductSpecArea::where("spec_area_id","=",$specareaId)->orderBy('index')->get();
        
        foreach ($alliances as $index => $alliance) {
            $alliance->index = $index + 1;
            $alliance->save();
        }
    }

}
