<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/global', [ProductController::class, 'indexGlobal']);

// Route registry for authentication related endpoints
Route::prefix('auth')-> group(function() {
    Route::post('/signup' , [AuthController::class, 'signup']);
    Route::post('/signin' , [AuthController::class, 'signin']);
});

// Route registry for product related endpoints
Route::prefix('products') -> group(function() {
    Route::get('/' , [ProductController::class, 'index']);
    Route::get('/global' , [ProductController::class, 'indexGlobal']);
});

