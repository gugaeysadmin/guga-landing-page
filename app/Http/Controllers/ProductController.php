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
        try{
            $newProduct = [];
    
            $newProduct['name'] = $request->name;
            $newProduct['description'] = $request->description;
            $newProduct['brand_id'] = $request->brand_id;
            $newProduct['active'] = 1;
    
            $newProduct['has_accesrorypdf'] = $request->has_accesrorypdf ? 1 : 0;
            $newProduct['has_services'] = $request->has_services ? 1 : 0;
            $newProduct['has_table'] = $request->has_table ? 1 : 0;
    
            $accesoryPdfUrl = "";
    
            if ($request->has_services) {
                $newProduct['services_description'] = $request->services_description;
            } else {
                $newProduct['services_description'] = null;
            }

            if ($request->has_accesrorypdf){
                if ($request->hasFile('accesorypdf')){
                    $accesoryPdfUrl= $request->file('accesorypdf')->store('productAccesory', 'public');
                }

                $newProduct['accesorypdf'] = $accesoryPdfUrl ;
                $newProduct['accesorypdf_id'] = $request->catalogaccesrorypdf;
                $newProduct['pdf_page'] = $request->has_page;
    
            }else{
                $newProduct['pdf_page'] = null;
                $newProduct['accesorypdf'] = null;
                $newProduct['accesorypdf_id'] = null;
            }

            
            DB::beginTransaction();
            
            $product = Product::create($newProduct);
            
            $specareas = json_decode($request->specAreas);
            $categories = json_decode($request->categories);
            
            $product->category()->sync($categories);
            
            
;

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
                                $url = $file->store('tablepdfs', 'public');
                                $row[$header] = $url; 
                       }else if($header == "imagen" && $tablerows[$header] && $tablerows[$header] != null ){
                            $file = $tablerows[$header]; // Ya es un UploadedFile
                            $url = $file->store('productImages', 'public');
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
    
            $product->has_accesrorypdf = $request->has_accesrorypdf ? 1 : 0;
            $product->has_services = $request->has_services ? 1 : 0;
            $product->has_table = $request->has_table ? 1 : 0;

            $accesoryPdfUrl = "";
    
            if ($request->has_services) {
                $product->services_description = $request->services_description;
            } else {
                $product->services_description = null;
            }

            if ($request->has_accesrorypdf){
                if ($request->hasFile('accesorypdf')){
                    $accesoryPdfUrl= $request->file('accesorypdf')->store('productAccesory', 'public');
                }

                $product->accesorypdf = $accesoryPdfUrl ;
                $product->accesorypdf_id = $request->catalogaccesrorypdf;
                $product->pdf_page = $request->has_page;
    
            }else{
                $product->pdf_page = null;
                $product->accesorypdf = null;
                $product->accesorypdf_id = null;
            }


            
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
