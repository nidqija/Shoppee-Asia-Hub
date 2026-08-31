<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SellerController extends Controller
{




    public function dashboard(Request $request): View
    {
        return view('seller_home');
    }
}



?>