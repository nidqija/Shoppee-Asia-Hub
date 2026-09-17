<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
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


        // get the cart of the user 
        $cart = $user ? Carts::where('user_id' , $user->id )->first() : null;

        // get the item amount from the user cart
        $cart_item_count = $cart ? CartItems::where('cart_id' , $cart->id)->sum('quantity') : 0;

        


        if(!$product){
            abort(404);
        }

        

        // call the view with the product and product count payload
        return view('product_page_id' , compact('product', 'product_count' , 'isSeller' , 'cart_item_count'));
    }

   
}


?>