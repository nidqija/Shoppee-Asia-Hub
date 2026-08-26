<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth_page');
});


Route::get("/home" , function(){
    return view('user_home');
});

Route::get("/seller-home" , function() {
    return view('seller_home');
});
