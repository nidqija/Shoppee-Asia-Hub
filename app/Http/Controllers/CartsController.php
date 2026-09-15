<?php 

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\CartItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;






class CartsController extends Controller {
    


    public function addToCart(Request $request) : JsonResponse {
        

        $validated = $request->validate([
            'product_id' => 'required|uuid',
            'quantity' => 'required|integer|min:1',
            'currency' => 'required|string|max:3',
        ]);



        $user = $request->user();

        // get the session id from an authorized user
        $sessionId = $request->hasSession() ? $request->session()->getId() : null;


        if(!$user && !$sessionId){
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated and session not found',
            ], 401);
        }



        $product = Product::find($validated['product_id']);

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }



        $cart = Carts::firstOrCreate([
            'user_id' => $user ? $user->id : null,
        ]); 


        $items = CartItems::where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();


        if($items){
            $items->quantity += $validated['quantity'];
            $items->save();

        }else{
            $newItem = CartItems::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'price' => $product->price,
            ]);

            $newItem->save();


            return response()->json([
                'status' => 'success',
                'message' => `Product added to cart successfully {$validated['quantity']} x {$product->name} at {$product->price} {$validated['currency']}`,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully',
        ]);
    }

    public function renderCartPage(Request $request) : View{
    

        return view('cart_page');
    }
}
?>