<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get("/home" , function(){
    return view('user_home');
});

Route::get("/seller-home" , function() {
    return view('seller_home');
});
