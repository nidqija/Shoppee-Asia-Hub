<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CartsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('products')->group(function () {
    Route::get('/global', [ProductController::class, 'indexGlobal']);
    Route::get('/seller/{seller_id}', [ProductController::class, 'RetrieveProductBySellerId']);
    Route::post('/update/{sku}', [ProductController::class, 'UpdateProductBySku']);
    Route::post('/add', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);

    // auth::sanctum is used to protect the api endpoint from unauthorized access
    Route::middleware('auth:sanctum')->post('/add-to-cart', [CartsController::class, 'addtoCart']);

});




// Route registry for authentication related endpoints
Route::prefix('auth')-> group(function() {
    Route::post('/signup' , [AuthController::class, 'signup']);
});

// Route registry for product related endpoints
Route::prefix('products') -> group(function() {
    Route::get('/' , [ProductController::class, 'index']);
    Route::get('/global' , [ProductController::class, 'indexGlobal']);
});




