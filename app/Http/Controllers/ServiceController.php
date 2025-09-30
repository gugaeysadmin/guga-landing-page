<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $services = Service::orderBy('index')->get();
            
            return response()->json([
                'success' => true,
                'data' => $services
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener servicio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener servicios'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nextIndex = (Service::max('index') ?? 0) + 1;

        // // Guardar la imagen
        $imagePath = $request->file('image')->store('services', 'public');

        
        $service = Service::create([
            'name' => $request['title'],
            'description' => $request['details'],
            'img_url' => $imagePath,
            'index' => $nextIndex
        ]);

        return response()->json([
            'message' => 'Servicio creada exitosamente',
            'data' => $service
        ], 201);

    }

    public function reorderIndexes()
    {
        $services = Service::orderBy('index')->get();
        
        foreach ($services as $index => $service) {
            $service->update(['index' => $index + 1]);
        }
        
        return response()->json(['message' => 'Índices reordenados']);
    }

    public function reorder(Request $request)
    {
        Log::info($request);
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:services,id',
            'updates.*.index' => 'required|integer|min:1'
        ]);
        
        try {
            DB::beginTransaction();
            
            foreach ($request->updates as $update) {
                Service::where('id', $update['id'])
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
    public function show(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $service
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener servicio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'servicio no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info($request);
        try {
            $service = Service::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'sometimes|string|max:100',
                'details' => 'sometimes|string',
            ]);

            // Actualizar campos básicos
            if (isset($validated['title'])) {
                $service->name = $validated['title'];
            }
            if (isset($validated['details'])) {
                $service->description = $validated['details'];
            }
            // Manejar la imagen si se proporciona
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($service->img_url && Storage::disk('public')->exists($service->img_url)) {
                    Storage::disk('public')->delete($service->img_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug($validated['title'] ?? $service->name).'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('specarea', $imageName, 'public');
                $service->img_url = $imagePath;
            }
            
            // Manejar el índice si se proporciona
            if (isset($validated['index'])) {
                $this->reorderSpecAreas($service, $validated['index']);
            }
            
            $service->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Oferta actualizada exitosamente',
                'data' => $service
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
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($service->img_url) {
                Storage::disk('public')->delete($service->img_url);
            }
            
            $service->delete();
            
            // Reordenar los índices restantes
            $this->reorderAllSpecAreas();
            
            return response()->json([
                'success' => true,
                'message' => 'Servicio eliminado exitosamente'
            ]);
            
        } catch (Exception $e) {
            Log::error('Error al eliminar servicio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el servicio'
            ], 500);
        }
    }

    /**
     * Reordenar áreas de especialidad cuando se cambia el índice de una
     */
    private function reorderSpecAreas(Service $movedOffert, $newIndex)
    {
        $currentIndex = $movedOffert->index;
        $maxIndex = Service::max('index');
        
        // Asegurar que el nuevo índice esté dentro de los límites
        $newIndex = max(1, min($newIndex, $maxIndex));
        
        if ($newIndex > $currentIndex) {
            // Mover hacia abajo en la lista
            Service::where('index', '>', $currentIndex)
                  ->where('index', '<=', $newIndex)
                  ->decrement('index');
        } elseif ($newIndex < $currentIndex) {
            // Mover hacia arriba en la lista
            Service::where('index', '>=', $newIndex)
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
        $services = Service::orderBy('index')->get();
        
        foreach ($services as $index => $service) {
            $service->index = $index + 1;
            $service->save();
        }
    }
}
