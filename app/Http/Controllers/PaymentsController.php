<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Braintree\Transaction;
use Braintree\Gateway;
use App\Promotion;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '',
            'publicKey' => '',
            'privateKey' => ''
        ]);

        $data=$request->all();


        $result = $gateway->transaction()->sale([
            'amount' => '2.0',
            'paymentMethodNonce' => $data['payment_Method_Nonce'],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


     // return view('checkout', compact('result'));
     return response()->json($result);
    }
}
