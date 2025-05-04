<?php

namespace App\Http\Controllers;

use App\Models\LandingPageConfig;
use Exception;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PageConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lpconfig = LandingPageConfig::findOrFail(1);
            
            return response()->json([
                'success' => true,
                'data' => $lpconfig
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener la configuración de la página: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la configuración de la página'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // // Guardar la imagen
        $imagePath = $request->file('main_video_url')->store('gugalp', 'public');

        
        $lpconfig = LandingPageConfig::create([
            'mission' => $request['mission'],
            'vission' => $request['vission'],
            'values' => $request['values'],
            'services_description' => $request['services_description'],
            'main_description' => $request['main_description'],
            'main_video_url' => $imagePath,
            'about_us' => $request['about_us'],
            'special_ofert' => $request['special_ofert'],
            'contact_phone' => $request['contact_phone'],
            'contact_phone_alternative' => $request['contact_phone_alternative'],
            'contact_email' => $request['contact_email'],
            'address' => $request['address'],
        ]);

        return response()->json([
            'message' => 'Oferta creada exitosamente',
            'data' => $lpconfig
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $lpconfig = LandingPageConfig::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $lpconfig
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener la configuración de la página: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la configuración de la página'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
            Log::info($request);
            $lpconfig = LandingPageConfig::findOrFail(1);
            
            $validated = $request->validate([
                'mission' => 'sometimes|string',
                'vission' => 'sometimes|string',
                'values' => 'sometimes|string',
                'services_description' => 'sometimes|string',
                'special_ofert' => 'sometimes|string',
                'main_description' => 'sometimes|string',
                'about_us' => 'sometimes|string',
                'contact_phone' => 'sometimes|string|max:20',
                'contact_phone_alternative' => 'sometimes|string|max:20',
                'contact_email' => 'sometimes|string|max:50',
                'address' => 'sometimes|string',
                'catalogs_filters' => 'sometimes|string',
            ]);

            // Actualizar campos básicos
            if (isset($validated['mission'])) {
                $lpconfig->mission = $validated['mission'];
            }
            if (isset($validated['vission'])) {
                $lpconfig->vission = $validated['vission'];
            }
            if (isset($validated['values'])) {
                $lpconfig->values = $validated['values'];
            }
            if (isset($validated['services_description'])) {
                $lpconfig->services_description = $validated['services_description'];
            }
            if (isset($validated['main_description'])) {
                $lpconfig->main_description = $validated['main_description'];
            }
            if (isset($validated['about_us'])) {
                $lpconfig->about_us = $validated['about_us'];
            }
            if (isset($validated['special_ofert'])) {
                $lpconfig->special_ofert = $validated['special_ofert'];
            }
            if (isset($validated['contact_phone'])) {
                $lpconfig->contact_phone = $validated['contact_phone'];
            }
            if (isset($validated['contact_phone_alternative'])) {
                $lpconfig->contact_phone_alternative = $validated['contact_phone_alternative'];
            }
            if (isset($validated['contact_email'])) {
                $lpconfig->contact_email = $validated['contact_email'];
            }
            if (isset($validated['address'])) {
                $lpconfig->address = $validated['address'];
            }
            if (isset($validated['catalogs_filters'])) {
                $lpconfig->catalogs_filters = $validated['catalogs_filters'];
            }
            
            // Manejar la imagen si se proporciona
            if ($request->hasFile('main_video_url')) {
                // Eliminar la imagen anterior si existe
                if ($lpconfig->main_video_url) {
                    
                    Storage::disk('public')->delete($lpconfig->main_video_url);
                }
                
                // Guardar la nueva imagen
                $imageName = time().'_'.Str::slug('lpmainvideo').'.'.$request->image->extension();
                $imagePath = $request->image->storeAs('lpconfig', $imageName, 'public');
                $lpconfig->main_video_url = $imagePath;
            }
            
            $lpconfig->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Lp config actualizada exitosamente',
                'data' => $lpconfig
            ]);
            
        
    }

    public function reupdate(Request $request)
    {
            $lpconfig = LandingPageConfig::findOrFail(1);
            $lpconfig->mission = $request['mission'];
            $lpconfig->vission = $request['vission'];
            $lpconfig->values = $request['values'];
            $lpconfig->services_description = $request['services_description'];
            $lpconfig->main_description = $request['main_description'];
            $lpconfig->about_us = $request['about_us'];
            $lpconfig->contact_phone = $request['contact_phone'];
            $lpconfig->contact_phone_alternative = $request['contact_phone_alternative'];
            $lpconfig->contact_email = $request['contact_email'];
            $lpconfig->address = $request['address'];

            
            $lpconfig->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Lp config actualizada exitosamente',
                'data' => $lpconfig
            ]);
            
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
