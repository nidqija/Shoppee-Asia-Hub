<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\View\View;




class ProductController extends Controller{


   


    public function renderbyId(Request $request , string $id ): View
    {


        $product = Product::find($id);

        // function to get the count of products by the same seller
        $products = Product::where('seller_id', $product->seller_id)->get();


        // get the count of products by the same seller
        $product_count = $products->count();


        $user = $request->user();
        $isSeller = $user !== null && ($user->id === $product->seller_id);


        // get the checkout item amountj
        $checkout_item = Carts::where('user_id', $user ? $user->id : null)
            ->with(['cartItems' => function ($query) use ($product) {
                $query->where('product_id', $product->id);
            }]);


        


        if(!$product){
            abort(404);
        }

        

        // call the view with the product and product count payload
        return view('product_page_id' , compact('product', 'product_count' , 'isSeller' , 'checkout_item'));
    }

   
}


?>