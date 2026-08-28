<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use illuminate\Support\Facades\DB;
use Throwable;

class ProductController extends Controller
{


        
    
        // function to query all products from the database and return as json response
        public function index(Request $request): JsonResponse{
                

                // query all products from the database with their category relationship
                $products = Product::all();

                // return the products as json response with status, region, connected database and count of products
                return response()->json([
                        'status' => 'success',
                        'region' => config('app.current_region' , 'MY'), // MY is the default region if not set in the config
                        'connected_database' => DB::connection()->getDatabaseName(), // get the name of the connected database
                        'count' => $products->count(),
                        'data' => $products
                ]);
        }


        public function indexGlobal(Request $request): JsonResponse{


                $allShards = ['shard_my' , 'shard_sg']; // lists all the shards that we want to query for global products
                $globalProducts = collect(); // create an empty collection to hold the products from all shards


                // loop over all the shards
                foreach($allShards as $shard){
                    $products = Product::on($shard)->get(); // query the products from the current shard

                    // concatenate the products from the current shard to the global products collection ( to merge the products from all shards into one collection)
                    $globalProducts = $globalProducts->concat($products); 

                }


                // return the global products as json response with status, scope, and count of products
                // we set scope to global to indicate that these products are from all shards and not just the current shard
                return response()->json([
                     'status' => 'success',
                     'scope' => 'global',
                     'count' => $globalProducts->count(),
                     'data' => $globalProducts
                ]);


        }



        
        // helper function to resolve the shard connection based on the provided region code
        // this function is used to map out the region code from user payload to the corresponding shard connection name
        private function resolveShardConnection(?string $regionCode): string
        {
                $normalized = strtoupper(trim($regionCode ?? 'MY'));

                $shardMap = [
                'MY' => 'shard_my',
                'SG' => 'shard_sg',
                ];

                return $shardMap[$normalized] ?? 'shard_my';
        }


    // function to store a new product in the database and return as json response
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title'          => 'required|string|max:255',
                'description'    => 'required|string',
                'price'          => 'required|numeric|min:0',
                'category_slug'  => 'required|string|max:255',
                'region_code'    => 'required|string|max:10',
                'stock_quantity' => 'required|integer|min:0',
            ]);

            // determine the shard connection based on provided region_code 
            // retrieved from local storage in the frontend and sent in the request body
            $shard = $request->input('shard', $this->resolveShardConnection($validated['region_code']));

            // create a new product instance and set the connection to the determined shard
            // this will open a transaction on the correct database shard and save the product in that shard
            $product = (new Product())->setConnection($shard);
            $product->fill([
                'title'          => $validated['title'],
                'description'    => $validated['description'],
                'price'          => $validated['price'],
                'category_slug'  => $validated['category_slug'],
                'region_code'    => strtoupper($validated['region_code']),
                'stock_quantity' => $validated['stock_quantity'],
                'status'         => 'active',
            ]);

            $product->save();

            // return a success response with the created product and the shard it was stored in
            return response()->json([
                'status'             => 'success',
                'message'            => 'Product created successfully',
                'shard'              => $shard,
                'connected_database' => DB::connection($shard)->getDatabaseName(),
                'data'               => $product,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation error',
                'errors'  => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            // Returns exact PHP/Database exception as JSON
            return response()->json([
                'status'    => 'error',
                'exception' => get_class($e),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ], 500);
        }
    }

    
      
}
