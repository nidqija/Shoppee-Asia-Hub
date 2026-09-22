<?php 

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PaymentOrderController extends Controller{



    



    public function renderCheckoutPage(Request $request , string $productId , string $regionCode) : View{
        


        $user = $request->user();

        $product = Product::find($productId);
        

        if(!$product){
            abort(404);
            
        }

        return view('checkout_page' , compact('product' , 'regionCode'));

    }

    
     public function createInvoice(Request $request) {

            $shipping_address = "123 Main St, Anytown, USA";
            $payment_method = "Xendit";
            $payment_status = "Pending";
            $status = "Pending";
            $shipped_at = null;
            $completed_at = null;


            // validate request from user based on params below
            $request->validate([
                'product_id' => 'required',
                'amount' => 'required|numeric',
                'currency' => 'required|string',
                'email' => 'required|email',

            ]);

            
            $externalId = 'order-' . Str::uuid();

            // use xendit secret key to call the endpoint to generate the invoice with related params
            $response = Http::withBasicAuth(config('services.xendit.secret_key' ), '')
            
                ->post('https://api.xendit.co/v2/invoices' , [
                   'external_id' => $externalId,
                   'amount' => $request->amount,
                   'payer_email' => $request->email,
                   'description' => 'Payment for order' . $externalId,
                   'currency' => $request->currency,
                   'success_redirect_url' => url("/payment-success"),
                   'failure_redirect_url' => url("/payment-failure"),

                ]);


                // if reponse successful, return the invoice id and invoice url
                if($response->successful()) {
                    $invoice = $response->json();


                    Order::create([
                        'user_id' => auth()->id()?? null,
                        'order_code' => $externalId,
                        'shipping_address' => $shipping_address,
                        'amount' => $request->amount,
                        'currency' => $request->currency,
                        'payment_method' => $payment_method,
                        'payment_status' => $payment_status,
                        'invoice_id' => $invoice['id'],
                        'status' => $status,
                        'shipped_at' => $shipped_at,
                        'completed_at' => $completed_at,
                    ]);


                    return response()->json([
                        'status' => 'success',
                        'invoice_url' => $invoice['invoice_url'],
                        'invoice_id' => $invoice['id'],
                    ]);
                }


                // if failed , return the error message
                return response()->json([
                    'status' => 'error',
                    'message' => $response->json()['error_code'] ?? 'Failed to create invoice',
                ] , 400);
            
        }


        public function handlePaymentSuccess(Request $request): View
        {
            return view('payment_success');
        }

        public function handlePaymentFailure(Request $request): View
        {
            return view('payment_failure');
        }

        public function handleWebhook(Request $request)
        {
            $incomingCallBackToken = $request->header('x-callback-token');

            $expectedToken = config('services.xendit.callback_token');
            
            if($expectedToken && $incomingCallBackToken != $expectedToken){
                Log::warning("Unauthroized Xendit webhook attempt" , [
                    'received_token' => $incomingCallBackToken,
                    'ip' => $request->ip()
                ]);

                return response()-> json(['message' => 'Unauthorized'], 401);
            }


            $payload = $request->all();

            Log::info('Xendit Webhook Received: ' , $payload);

            $externalId = $payload['external_id'] ?? 'default_external_id';
            $invoiceId = $payload['id'] ?? 'default_id';
            $status = $payload['status'] ?? 'default_status';
            $paymentMethod = $payload['payment_method'] ?? null;
            $paidAmount = $payload['paid_amount'] ?? null;
            $paidAt = $payload['paid_at'] ?? null;

            if(!$externalId || !$invoiceId || !$status){
                return response()->json(['message' => 'Invalid Payload'] , 400);
            }


            switch(strtoupper($status)){
                case 'PAID':
                    $order = Order::where('invoice_id' , $invoiceId)->first();

                    if (!$order){
                        Log::warning('Order not found for invoice ID: ' . $invoiceId);
                        return response()->json(['message' => 'Order not found'] , 404);
                    }

                    if ($order->status !== 'PAID'){
                        $order->update([
                            'status' => 'PAID',
                            'payment_method' => $paymentMethod,
                            'paid_amount' => $paidAmount,
                            'paid_at' => $paidAt,
                        ]);


                        Log::info('Order #' . $order->id . ' updated to paid via webhook.' , [
                            'payment_method' => $paymentMethod,
                            'amount' => $paidAmount,
                            'paid_at' => $paidAt,
                        ]);
                    }
                break;

                


                default:
                    Log::info('Order #' . $invoiceId . ' received unknwon status: ' . $status);
                    break;
            }


            
            

            

            
            return response()->json([
                'status' => 'success',
                'message' => 'Webhook processed successfully'
            ], 200);
        }

   

}



?>