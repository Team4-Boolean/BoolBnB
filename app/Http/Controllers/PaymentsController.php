<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Braintree\Transaction;
use Braintree\Gateway;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {

    $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'j5kyxqgqgmc7d65n',
            'publicKey' => 'j2smq9sghg76qfdy',
            'privateKey' => '917dcc7dbb9f8005bb6f061e0d0ed01d'
        ]);

        $data=$request->all();

        $result = $gateway->transaction()->sale([
            'amount' => '1000.00',
            'paymentMethodNonce' => $data['payment_Method_Nonce'],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

     // return view('checkout', compact('result'));
     return response()->json($result);
    }
}
