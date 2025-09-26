<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Exception;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with([
                'brand' => function($query) {
                    $query->select('id', 'name');
                },
                'category' => function($query) {
                    $query->select('category_id', 'name');
                },
                'ProductSpecAreas.SpecArea' =>function($query) {
                    $query->select('id', 'name');
                },
            ])
            ->orderByDesc('updated_at')
            ->get();
            
            $response = [];
            // if($products){
            //     foreach($products as $product){
            //         $response= array_merge($response, array([
            //             "name" => $product->name,
            //             "description" => $product->description,
            //             "active" => $product->active ,
            //             "brand"=> $product->brand ? [$product->brand->name] : [],
            //             "categories"=>$product->category->pluck('name')->toArray(),
            //             "specareas"=>$product->productSpecAreas ?  $product->productSpecAreas->map(function($item) {
            //                 return $item->specArea->name ?? null; // Asumiendo relación con SpecArea
            //             })->filter()->values()->toArray(): [],
            //         ]));
            //     }
            // }

            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener los productos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos'
            ], 500);
        }
    }

    public function counting(){
        Log::info("is this");
        try {
            $products = Product::count();


            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener los productos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hashSeperator = "82fbcc113b80e3bebe876ed5add2564d";
        try{
            $newProduct = [];
            
            $newProduct['name'] = $request->name;
            $newProduct['description'] = $request->description;
            $newProduct['brand_id'] = $request->brand_id;
            $newProduct['active'] = 1;
            $newProduct['valid'] = 0;
    
            $newProduct['has_accesrorypdf'] = $request->has_accesrorypdf == 'true'? 1 : 0;
            $newProduct['has_services'] = $request->has_services == 'true'? 1 : 0;
            $newProduct['has_table'] = $request->has_table == 'true'? 1 : 0;
            $newProduct['has_supply'] = $request->has_supply == 'true' ? 1 : 0;
            $newProduct['has_manual'] = $request->has_manual == 'true'? 1 : 0;
            $newProduct['is_catalog'] = $request->is_catalog == 'true'? 1 : 0;


    
            $accesoryPdfUrl = "";
            $manualPdfUrl = "";
            $supplyPdfUrl = "";
            $catalogPdfUrl = "";

            
    
            if ($request->has_services) {
                $newProduct['services_description'] = $request->services_description;
            } else {
                $newProduct['services_description'] = null;
            }

            if ($request->has_accesrorypdf){
                if ($request->hasFile('accesorypdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('accesorypdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $accesoryPdfUrl = $file->storeAs('productAccesory',  $filename, 'public');
                }
                if (!empty($request->catalogaccesrorypdf) && $request->catalogaccesrorypdf !== "null") {
                    // $product->accesoryPdf()->associate($request->catalogaccesrorypdf);
                    $newProduct['accesorypdf_id'] = $request->catalogaccesrorypdf;
                }

                $newProduct['accesorypdf'] = $accesoryPdfUrl ;
                // $newProduct['accesorypdf_id'] = $request->catalogaccesrorypdf;
                $newProduct['pdf_page'] = $request->has_page;
    
            }else{
                $newProduct['pdf_page'] = null;
                $newProduct['accesorypdf'] = null;
                $newProduct['accesorypdf_id'] = null;
            }

            if ($request->has_manual){
                if ($request->hasFile('manualpdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('manualpdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $manualPdfUrl = $file->storeAs('productManuals',  $filename, 'public');
                    // $manualPdfUrl= $request->file('manualpdf')->store('productManuals', 'public');
                }
                $newProduct['manualpdf'] = $manualPdfUrl ;
            }

            if ($request->has_supply){
                if ($request->hasFile('supplypdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('supplypdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $supplyPdfUrl = $file->storeAs('productSupplies', $filename, 'public');
                    
                    // $supplyPdfUrl= $request->file('supplypdf')->store('productSupplies', 'public');
                }
                $newProduct['supplypdf'] = $supplyPdfUrl ;
            }

            if($request->is_catalog){
                if ($request->hasFile('catalogpdf')){
                    // $catalogPdfUrl= $request->file('catalogpdf')->store('productCatalogs', 'public');

                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('catalogpdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $catalogPdfUrl = $file->storeAs('productCatalogs', $filename, 'public');
                }
                $newProduct['catalogpdf'] = $catalogPdfUrl ;
            }

            
            DB::beginTransaction();
            
            $product = Product::create(attributes: $newProduct);
            
            $specareas = json_decode(json: $request->specAreas);
            $categories = json_decode($request->categories);
            
            $product->category()->sync($categories);
            
            

            foreach ($specareas as $specAreaId) {
                $currentCount = ProductSpecArea::where('spec_area_id', $specAreaId)->count();
                if(!$currentCount || $currentCount == null){
                    $currentCount = 0;
                }
                $product->productSpecAreas()->create([
                    'spec_area_id' => $specAreaId,
                    'index' => $currentCount + 1,
                    'product_id' => $product->id
                ]);
            }
            
            
            if($request->productImages){
                foreach($request->productImages as $productImage){
                    if($productImage["type"] == 'url')
                        $product->productImages()->create([
                        'url' => $productImage["url"],
                        'index'=> $productImage["index"],
                        'type'=> json_encode($productImage["type"]),
                        'active'=>1,
                    ]);
                    else{
                        $file = $productImage['file'];
                        $url = $file->store('productImages', 'public');
                        $product->productImages()->create([
                            'url' => $url,
                            'index'=> $productImage["index"],
                            'type'=> json_encode($productImage["type"]),
                            'active'=>1,
                        ]);
                        
                    }
                    
                }
            }

            if($request->has_table){
                $piMaxInex = 0;
                if($request->productImages){
                    $piMaxInex = count($request->productImages); 
                }
                $headers = json_decode($request->table_data_headers);
                $table = [];
                $imageCouter=0;

                if($request->table_data &&$request->table_data_headers ){
                    
                    foreach($request->table_data as $tablerows){
                        $row = [];
                        foreach($headers as $header){
                        if($header == "pdf" && $tablerows[$header] && $tablerows[$header] != null  ){
                                    $file = $tablerows[$header]; ; // Ya es un UploadedFile
                                    $uuid = Uuid::uuid4()->toString();
                                    // Nombre original
                                    $originalName = $file->getClientOriginalName();

                                    // Extensión
                                    $extension = $file->getClientOriginalExtension();

                                    // Construimos el nombre nuevo
                                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                                    // Guardamos con storeAs
                                    $url = $file->storeAs('tablepdfs', $filename, 'public');
                                    // $url = $file->store('tablepdfs', 'public');
                                    $row[$header] = $url; 
                        }else if($header == "imagen" && $tablerows[$header] && $tablerows[$header] != null ){
                                $file = $tablerows[$header]; // Ya es un UploadedFile
                                $uuid = Uuid::uuid4()->toString();
                                // Nombre original
                                $originalName = $file->getClientOriginalName();

                                // Extensión
                                $extension = $file->getClientOriginalExtension();

                                // Construimos el nombre nuevo
                                $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                                // Guardamos con storeAs
                                $url = $file->storeAs('productImages', $filename, 'public');
                                // $url = $file->store('productImages', 'public');
                                $product->productImages()->create([
                                    'url' => $url,
                                    'index'=> $piMaxInex + $imageCouter + 1,
                                    'type'=> json_encode($file->getMimeType()),
                                    'active'=>1,
                                ]);
                                $row[$header] = $url;
                                $row['position'] = $piMaxInex + $imageCouter + 1; 
                                $imageCouter =  $imageCouter + 1;
                        }else{
                            $row[$header] = $tablerows[$header];                    
                        }
                        }
                        $table = array_merge($table,array($row));
                    }

                }
                
                $tableData = [
                    'headers'=> $headers,
                    'table'=> $table
                ];
                $product->table_data = json_encode($tableData);

                if(!empty($request->table_id)){
                    $product->table_id = $request->table_id;
                }
            }

            $product->save();
            
            DB::commit();
            
            return response()->json([
                'message' => 'Producto creado exitosamente',
                'data' => true
            ], 201);

        }catch (Exception $e) {
            DB::rollBack();
            Log::error('Error  crear producto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear producto'
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with([
                'brand' => function($query) {
                    $query->select('id', 'name');
                },
                'category' => function($query) {
                    $query->select('category_id', 'name');
                },
                'ProductSpecAreas.SpecArea' =>function($query) {
                    $query->select('id', 'name');
                },
                'ProductImages' =>function($query) {
                    $query->select('id','product_id', 'url', 'type', 'index','active');
                }
            ])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener producto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hashSeperator = "82fbcc113b80e3bebe876ed5add2564d";

        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $validated = $request->validate([
                'active' => 'sometimes|boolean',
            ]);

            if (isset($validated['active'])) {
                $product->active = $validated['active'];
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->brand_id = $request->brand_id;
            $product->active = 1;
            
            $product->has_accesrorypdf = $request->has_accesrorypdf == 'true'? 1 : 0;
            $product->has_services = $request->has_services == 'true'? 1 : 0;
            $product->has_table = $request->has_table == 'true'? 1 : 0;
            $product->has_supply = $request->has_supply == 'true' ? 1 : 0;
            $product->has_manual  = $request->has_manual == 'true'? 1 : 0;
            $product->is_catalog = $request->is_catalog == 'true'? 1 : 0;
            
            
            $accesoryPdfUrl = "";
            if(!empty($request->table_id) && $request->table_id !== "null" && $request->table_id !== null){
                $product->productTableConfiguration()->associate($request->table_id);
            }else{
                $product->productTableConfiguration()->dissociate();
            }
    
            if ($request->has_services == 'true') {
                $product->services_description = $request->services_description;
            }
            if ($request->has_accesrorypdf == 'true'){
                if ($request->hasFile(key: 'accesorypdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('accesorypdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $product->accesorypdf =  $file->storeAs('productAccesory', $filename, 'public');
                    // $product->accesorypdf = $request->file('accesorypdf')->store('productAccesory', 'public');
                }else if($request->accesorypdf !== null && $request->accesorypdf !== "" && $request->accesorypdf !== "null" && $request->accesorypdf !== "undefined"){ 
                    $product->accesorypdf = $accesoryPdfUrl;
                }
                
                if (!empty($request->catalogaccesrorypdf) && $request->catalogaccesrorypdf !== "null") {
                    $product->accesoryPdf()->associate($request->catalogaccesrorypdf);
                }else {
                    $product->accesoryPdf()->dissociate();
                }
                $product->pdf_page = $request->has_page;
    
            }

            if ($request->has_manual == 'true'){
                if ($request->hasFile('manualpdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('manualpdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $product->manualpdf =  $file->storeAs('productManuals', $filename, 'public');
                    // $product->manualpdf = $request->file('manualpdf')->store('productManuals', 'public');
                } else if($request->manualpdf !== null && $request->manualpdf !== "" && $request->manualpdf !== "null" && $request->manualpdf !== "undefined"){
                    $product->manualpdf = $request->manualpdf;
                } 
            }

            if ($request->has_supply == 'true'){
                if ($request->hasFile('supplypdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('supplypdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $product->supplypdf =  $file->storeAs('productSupplies', $filename, 'public');
                    // $product->supplypdf = $request->file('supplypdf')->store('productSupplies', 'public');
                } else if ($request->supplypdf !== null && $request->supplypdf !== "" && $request->supplypdf !== "null" && $request->supplypdf !== "undefined"){
                    $product->supplypdf = $request->supplypdf;
                }
            }

            if ($request->is_catalog == 'true'){
                if ($request->hasFile('catalogpdf')){
                    $uuid = Uuid::uuid4()->toString();
                    $file = $request->file('catalogpdf');

                    // Nombre original
                    $originalName = $file->getClientOriginalName();

                    // Extensión
                    $extension = $file->getClientOriginalExtension();

                    // Construimos el nombre nuevo
                    $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                    // Guardamos con storeAs
                    $product->catalogpdf = $file->storeAs('productCatalogs', $filename, options: 'public');
                    // $product->catalogpdf = $request->file('catalogpdf')->store('productCatalogs', 'public');
                }else if ($request->catalogpdf !== null && $request->catalogpdf !== "" && $request->catalogpdf !== "null" && $request->catalogpdf !== "undefined"){
                    $product->catalogpdf = $request->catalogpdf;  
                }
            }
            
            if($request->categories){
                $categories = json_decode($request->categories);
                if($categories  && count($categories) > 0){
                    $product->category()->sync($categories);
                } else {
                    // Si viene vacío, limpiar
                    $product->category()->sync([]);
                }
            }else{
                $product->category()->sync([]);
            }

            if($request->specAreas)   {
                $specareas = json_decode($request->specAreas);

                if ($specareas && count($specareas) > 0) {
                    $product->productSpecAreas()
                        ->whereNotIn('spec_area_id', $specareas)
                        ->delete();
                    foreach ($specareas as $specAreaId) {
                        $currentCount = ProductSpecArea::where('spec_area_id', $specAreaId)->count();

                        $product->productSpecAreas()->updateOrCreate(
                            ['spec_area_id' => $specAreaId, 'product_id' => $product->id],
                            ['index' => $currentCount + 1]
                        );
                    }
                } else {
                    // Si viene vacío, limpiar
                    $product->productSpecAreas()->delete();
                }
            } else {
                $product->productSpecAreas()->delete();
            }      

            if (!empty($request->productImages) && $request->productImages !== "null" && $request->productImages !== null) {
                // 1. Obtener las imágenes actuales
                $currentImages = $product->productImages->keyBy('id');

                // 2. Crear array de URLs o identificadores de las imágenes recibidas
                $incomingImageUrls = collect($request->productImages)->pluck('url')->filter()->toArray();

                // 3. Identificar imágenes a eliminar (las que existen en BD pero no en el request)
                $imagesToDelete = $currentImages->filter(function ($currentImage) use ($incomingImageUrls) {
                    return !in_array($currentImage->url, $incomingImageUrls);
                });


                // if ($request->productImages) {
                //     foreach ($request->productImages as $productImage) {
                        
                //         if (!empty($productImage['id'])) {
                //             continue;
                //         }

                //         if($productImage["type"] == 'url')
                //             $product->productImages()->create([
                //             'url' => $productImage["url"],
                //             'index'=> $productImage["index"],
                //             'type'=> json_encode($productImage["type"]),
                //             'active'=>1,
                //         ]);
                //         else{
                //             $file = $productImage['file'];
                //             $url = $file->store('productImages', 'public');
                //             $product->productImages()->create([
                //                 'url' => $url,
                //                 'index'=> $productImage["index"],
                //                 'type'=> json_encode($productImage["type"]),
                //                 'active'=>1,
                //             ]);
                            
                //         }
                //     }  
                // }
                
                
                $incomingIds = [];

                foreach ($request->productImages as $productImage) {
                    // Si viene con id => actualizar
                    if (!empty($productImage['id']) && $productImage['id'] != 'undefined') {
                        $image = $product->productImages()->find($productImage['id']);
                        if ($image) {
                            $image->update([
                                'url'   => $productImage['url'],
                                'index' => $productImage['index'],
                                'type'  => json_encode($productImage['type']),
                                'active'=> 1,
                            ]);
                            $incomingIds[] = $image->id;
                        }
                    } 
                    // Si no tiene id => es nuevo
                    else {
                        if ($productImage['type'] == 'url') {
                            $newImage = $product->productImages()->create([
                                'url'   => $productImage['url'],
                                'index' => $productImage['index'],
                                'type'  => json_encode($productImage['type']),
                                'active'=> 1,
                            ]);
                        } else {
                            if (isset($productImage['file']) && $productImage['file'] instanceof \Illuminate\Http\UploadedFile) {
                                $url = $productImage['file']->store('productImages', 'public');
                                $newImage = $product->productImages()->create([
                                    'url'   => $url,
                                    'index' => $productImage['index'],
                                    'type'  => json_encode($productImage['type']),
                                    'active'=> 1,
                                ]);
                            }
                        }
                        if (isset($newImage)) {
                            $incomingIds[] = $newImage->id;
                        }
                    }
                }

                // Eliminar las que ya no vienen
                $toDelete = $product->productImages()
                    ->whereNotIn('id', $incomingIds)
                    ->get();

                foreach ($toDelete as $image) {
                    // Solo borramos del storage si es un archivo local
                    // tus urls guardadas con store() quedan como "productImages/archivo.jpg"
                    if ($image->url && !filter_var($image->url, FILTER_VALIDATE_URL)) {
                        Storage::disk('public')->delete($image->url);
                    }

                    $image->delete();
                }

            
            } else {
                // Si no mandan imágenes → borro todas
                $product->productImages()->delete();
            }

            if(!empty($request->table_data) && $request->table_data !== "null" && $request->table_data !== null){
                $piMaxIndex = $product->productImages()->max('index') ?? 0; // mejor que count()
                $headers = json_decode($request->table_data_headers, true);
                $table = [];
                $imageCounter = 0;

                if ($request->table_data && $headers) {
                    foreach ($request->table_data as $tablerows) {
                        $row = [];

                        foreach ($headers as $header) {
                            $value = $tablerows[$header] ?? null;

                            // Subida de PDFs
                            if ($header === "pdf" && $value instanceof \Illuminate\Http\UploadedFile) {
                                $uuid = Uuid::uuid4()->toString();
                                // $file = $request->file('supplypdf');

                                // Nombre original
                                $originalName = $value->getClientOriginalName();

                                // Extensión
                                $extension = $value->getClientOriginalExtension();

                                // Construimos el nombre nuevo
                                $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                                // Guardamos con storeAs
                                $url =  $value->storeAs('tablepdfs', $filename, 'public');
                                // $url = $value->store('tablepdfs', 'public');
                                $row[$header] = $url;
                            }
                            // Subida de imágenes
                            else if ($header === "imagen" && $value instanceof \Illuminate\Http\UploadedFile) {
                                $uuid = Uuid::uuid4()->toString();
                                // $file = $request->file('supplypdf');

                                // Nombre original
                                $originalName = $value->getClientOriginalName();

                                // Extensión
                                $extension = $value->getClientOriginalExtension();

                                // Construimos el nombre nuevo
                                $filename = $uuid . '_'.$hashSeperator.'_' . pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;

                                // Guardamos con storeAs
                                $url =  $value->storeAs('productImages', $filename, 'public');
                                // $url = $value->store('productImages', 'public');

                                // Crear también en productImages
                                $newImage = $product->productImages()->create([
                                    'url'    => $url,
                                    'index'  => $piMaxIndex + $imageCounter + 1,
                                    'type'   => json_encode($value->getMimeType()),
                                    'active' => 1,
                                ]);

                                $row[$header] = $url;
                                $row['position'] = $newImage->index;
                                $imageCounter++;
                            }
                            // Cuando viene string (ya guardado previamente)
                            else {
                                $row[$header] = $value;
                            }
                        }

                        $table[] = $row;
                    }
                }

                $tableData = [
                    'headers' => $headers,
                    'table'   => $table,
                ];

                $product->table_data = json_encode($tableData);
            } else {
                $product->table_data = json_encode([
                    'headers' => [],
                    'table'   => [],
                ]);
                $product->productTableConfiguration()->dissociate();
                $product->has_table = 0;
            }

            Log::info($request->table_data);

            $product->save();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Oferta actualizada exitosamente',
                'data' => $product
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar oferta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la oferta'
            ], 500);
        }
    }

    public function status(Request $request, string $id)
    {
        try {
            $offert = Product::findOrFail($id);
            
            $validated = $request->validate([
                'active' => 'sometimes|boolean',
            ]);

            if (isset($validated['active'])) {
                $offert->active = $validated['active'];
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
    public function destroy(string $id, ProductSpecAreaController $productController)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            
            // Eliminar la imagen asociada
            if ($product->has_accesrorypdf) {
                if($product->accesorypdf ){
                    Storage::disk('public')->delete($product->accesorypdf);
                }
            }

            if ($product->is_catalog) {
                if($product->catalogpdf ){
                    Storage::disk('public')->delete($product->catalogpdf);
                }
            }

            if ($product->has_manual) {
                if($product->manualpdf ){
                    Storage::disk('public')->delete($product->manualpdf);
                }
            } 

            if ($product->has_supply) {
                if($product->supplypdf ){
                    Storage::disk('public')->delete($product->supplypdf);
                }
            } 

            $images = ProductImage::where("product_id", '=',$id)->get();
            
            if($images || $images == null){
                foreach($images as $image){
                    if($image->type !== "url" && $image->url && $image->url !== null){
                        Storage::disk(name: 'public')->delete($image->url);
                    }
                }
            }

            $tabledata = [];
            $tables= [];
            if($product->has_table || $product->has_table == 1){
                $tabledata = json_decode($product->table_data);
                $tables = $tabledata->table;
                if($tables && $tables !== null){
                    foreach($tables as $table){
                        if($table->pdf && $table->pdf !== null && $table->pdf !== ""){
                            Storage::disk('public')->delete($table->pdf);
                        }
                        if($table->imagen && $table->imagen !== null && $table->imagen !== ""){
                            Storage::disk('public')->delete($table->imagen);
                        }
                        
                    }
                }
            
            }

            $specAreas = $product->productSpecAreas()->get();
            
            $product->delete();

            if($specAreas && $specAreas !== null){
                foreach($specAreas as $specArea){
                    $productController->reorderAllSpecArea($specArea->spec_area_id);
                }
            }

            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Oferta eliminada exitosamente'
            ]);
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar oferta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la oferta'
            ], 500);
        }
    }


}
