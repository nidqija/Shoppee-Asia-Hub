<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ResolveRegionalShard
{
    // function to resolve regional shard based on the X-Region header in the request
    // its a middleware that will be executed before the request is handled by the controller
    public function handle(Request $request, Closure $next) : Response {

        $region = strtolower($request->header('X-Region', 'my'));  // default to MY if not provided
        $connectionName = "shard_{$region}"; // construct the connection name based on the region

        // if no config has the connection name , then return error
        if(!config()-> has("database.connections.{$connectionName}")) {
            return response()->json(['error' => 'Invalid region specified'], 400);
        }


        // set the default connection for the request
        DB::setDefaultConnection($connectionName); 

        // inject region code into config for downstream access if needed
        config(['app.current_region' => strtoupper($region)]);


        return $next($request);

       
    }
}
