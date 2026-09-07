<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;




class ProductController extends Controller{
    public function renderbyId(Request $request , string $id ): View
    {


        $product = Product::find($id);

        

        if(!$product){
            abort(404);
        }


        return view('product_page_id' , compact('product'));
    }

   
}


?>