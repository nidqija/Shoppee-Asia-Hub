<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentOrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('auth_page');
})->name('login');


Route::get("/home", function () {
    return view('user_home');
});

Route::post('/api/auth/signin', [AuthController::class, 'signin']);


Route::get('/seller-home', [SellerController::class, 'dashboard'])->name('seller.dashboard');




Route::get('/product-page-id/{productId}', [ProductController::class, 'renderbyId'])->name('product.renderbyId');
Route::get('/checkout-page-id/{productId}/{regionCode}', [PaymentOrderController::class, 'renderCheckoutPage'])->name('product.renderCheckoutPage');
Route::get('/cart-page', [CartController::class, 'renderCartPage'])->name('cart.renderCartPage');