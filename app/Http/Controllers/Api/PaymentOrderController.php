<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;








class PaymentOrderController extends Controller {


        public function storePaymentOrder(Request $request): JsonResponse{


            $validated = $request->validate([
                'product_id' => 'required|uuid|exists:products,id',
                'region_code' => 'required|string|max:10',
                'quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:0',
            ]);

            



        }


       
}


?>