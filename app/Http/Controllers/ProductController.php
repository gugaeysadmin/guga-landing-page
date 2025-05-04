<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
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
            if(!$currentCount || $currentCount = null)
                $currentCount = 0;
            $product->productSpecAreas()->create([
                'spec_area_id' => $specAreaId,
                'priority' => $currentCount + 1, // La nueva prioridad será: total actual + 1
                'product_id' => $product->id
            ]);
        }
        
        
        if($request->productImagesas){
            foreach($request->productImagesas as $productImage){
                if($productImage["type"] == 'url')
                    $product->productImages()->create([
                    'url' => $productImage["url"],
                    'index'=> $productImage["index"],
                    'type'=> json_encode($productImage["type"]),
                    'active'=>1,
                ]);
                else{
                    $file = $productImage['file']; // Ya es un UploadedFile
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
            Log::error('Error  crear producto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear producto'
            ], 500);
        }
        
    }

    // public function reorderIndexes()
    // {
    //     $offerts = Offert::orderBy('index')->get();
        
    //     foreach ($offerts as $index => $offert) {
    //         $offert->update(['index' => $index + 1]);
    //     }
        
    //     return response()->json(['message' => 'Índices reordenados']);
    // }

    // public function reorder(Request $request)
    // {
    //     Log::info($request);
    //     $request->validate([
    //         'updates' => 'required|array',
    //         'updates.*.id' => 'required|exists:offerts,id',
    //         'updates.*.index' => 'required|integer|min:1'
    //     ]);
        
    //     try {
    //         DB::beginTransaction();
            
    //         foreach ($request->updates as $update) {
    //             Offert::where('id', $update['id'])
    //                  ->update(['index' => $update['index']]);
    //         }
            
    //         DB::commit();
    //         return response()->json(['success' => true]);
            
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            
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
            $offert = Product::findOrFail($id);
            
            $validated = $request->validate([
                'active' => 'sometimes|boolean',
            ]);

            if (isset($validated['active'])) {
                $offert->active = $validated['active'];
            }
            
            // // Manejar la imagen si se proporciona
            // if ($request->hasFile('image')) {
            //     // Eliminar la imagen anterior si existe
            //     if ($offert->img_url) {
            //         Storage::disk('public')->delete($offert->img_url);
            //     }
                
            //     // Guardar la nueva imagen
            //     $imageName = time().'_'.Str::slug($validated['title'] ?? $offert->name).'.'.$request->image->extension();
            //     $imagePath = $request->image->storeAs('offerts', $imageName, 'public');
            //     $offert->img_url = $imagePath;
            // }

            
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
    public function destroy(string $id)
    {
        //
    }


    /**
     * Reordenar ofertas cuando se cambia el índice de una
     */
    // private function reorderOfferts(Product $movedOffert, $newIndex)
    // {

    //     $currentIndex = $movedOffert->index;
    //     $maxIndex = Offert::max('index');
        
    //     // Asegurar que el nuevo índice esté dentro de los límites
    //     $newIndex = max(1, min($newIndex, $maxIndex));
        
    //     if ($newIndex > $currentIndex) {
    //         // Mover hacia abajo en la lista
    //         Offert::where('index', '>', $currentIndex)
    //               ->where('index', '<=', $newIndex)
    //               ->decrement('index');
    //     } elseif ($newIndex < $currentIndex) {
    //         // Mover hacia arriba en la lista
    //         Offert::where('index', '>=', $newIndex)
    //               ->where('index', '<', $currentIndex)
    //               ->increment('index');
    //     }
        
    //     $movedOffert->index = $newIndex;
    // }

    /**
     * Reordenar todas las ofertas (después de eliminar)
     */
    // private function reorderAllOfferts()
    // {
    //     $offerts = ProductSpecArea::orderBy('index')->get();
        
    //     foreach ($offerts as $index => $offert) {
    //         $offert->index = $index + 1;
    //         $offert->save();
    //     }
    // }
}
