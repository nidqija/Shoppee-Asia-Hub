<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;






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