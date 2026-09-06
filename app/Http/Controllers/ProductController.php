<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class ProductController extends Controller{
    public function renderbyId(Request $request): View
    {
        return view('product_page_id');
    }
}


?>