<?php 

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;



class PaymentOrderController extends Controller{




    public function renderCheckoutPage(Request $request , string $productId , string $regionCode) : View{
        


        $user = $request->user();

        $product = Product::find($productId);
        

        if(!$product){
            abort(404);
            
        }

        return view('checkout_page' , compact('product' , 'regionCode'));

    }

}



?>