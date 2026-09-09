<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth_page');
})->name('login');


Route::get("/home", function () {
    return view('user_home');
});

Route::post('/api/auth/signin', [AuthController::class, 'signin']);


Route::get('/seller-home', [SellerController::class, 'dashboard'])->name('seller.dashboard');
Route::get('/product-page-id/{productId}', [ProductController::class, 'renderbyId'])->name('product.renderbyId');


