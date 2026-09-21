<?php 

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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


        public function handleWebhook(Request $request) {
            
        }


   

}



?>