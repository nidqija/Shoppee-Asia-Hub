<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use illuminate\Support\Facades\DB;

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
}
