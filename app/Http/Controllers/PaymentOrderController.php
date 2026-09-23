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

        $quantity = max(1, (int) $request->query('quantity', 1));

        return view('checkout_page' , compact('product' , 'regionCode', 'quantity'));

    }

    
     public function createInvoice(Request $request) {


            // static data for address , the rest are default data for invoice that will be updated after payment
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


                    // create order in database
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


                    // sends a successful response to payment page
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



        // function to handle callback from xendit
        public function handleWebhook(Request $request)
        {

            // fetch the callback token 
            $incomingCallBackToken = $request->header('x-callback-token');

            // get the expected token from xendit callback token
            $expectedToken = config('services.xendit.callback_token');
            

            // check if the incoming callback token matches the expected token
            // indicates that the callback request is coming from xendit
            // if not , block the request with a warning message and error return
            if($expectedToken && $incomingCallBackToken != $expectedToken){
                Log::warning("Unauthroized Xendit webhook attempt" , [
                    'received_token' => $incomingCallBackToken,
                    'ip' => $request->ip()
                ]);

                return response()-> json(['message' => 'Unauthorized'], 401);
            }


            // get the payload from the request
            $payload = $request->all();

            Log::info('Xendit Webhook Received: ' , $payload);

            // get the external id, invoice id, status, payment method, paid amount, and paid at from the payload
            $externalId = $payload['external_id'] ?? 'default_external_id';
            $invoiceId = $payload['id'] ?? 'default_id';
            $status = $payload['status'] ?? 'default_status';
            $paymentMethod = $payload['payment_method'] ?? null;
            $paidAmount = $payload['paid_amount'] ?? null;
            $paidAt = $payload['paid_at'] ?? null;


            // if there are no external id , invoice id , and status
            // block it with an error message saying that this is an invalid payload
            if(!$externalId || !$invoiceId || !$status){
                return response()->json(['message' => 'Invalid Payload'] , 400);
            }


            // check the status code from the payload
            switch(strtoupper($status)){
                case 'PAID':

                    $order = Order::where('invoice_id' , $invoiceId)->first();

                    // if the order not found , return error message with 404 status code
                    if (!$order){
                        Log::warning('Order not found for invoice ID: ' . $invoiceId);
                        return response()->json(['message' => 'Order not found'] , 404);
                    }

                    // if its paid , update the record order based on invoice id
                    if ($order->status !== 'PAID'){
                        $order->update([
                            'status' => 'PAID',
                            'payment_status' => 'FINISHED',
                            'payment_method' => $paymentMethod,
                            'paid_amount' => $paidAmount,
                            'paid_at' => $paidAt,
                        ]);

                        // log the updated order id and details
                        Log::info('Order #' . $order->id . ' updated to paid via webhook.' , [
                            'payment_method' => $paymentMethod,
                            'amount' => $paidAmount,
                            'paid_at' => $paidAt,
                        ]);
                    }
                break;

                

                // default response for any status other than mentioned
                default:
                    Log::info('Order #' . $invoiceId . ' received unknwon status: ' . $status);
                    break;
            }


            
            // return the response back to xendit after the execution is received
            return response()->json([
                'status' => 'success',
                'message' => 'Webhook processed successfully'
            ], 200);
        }

   

}



?>