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
            'merchantId' => 'j5kyxqgqgmc7d65n',
            'publicKey' => 'j2smq9sghg76qfdy',
            'privateKey' => '917dcc7dbb9f8005bb6f061e0d0ed01d'
        ]);

        $data = $request->all();
        // Prendo l'id relativo al mia promozione
        $promotionId = $request->input('promotion');

        // Pago la cifra in base alla promo selezionata
        if ($promotionId == 1) {
        $result = $gateway->transaction()->sale([
            'amount' => '2.99',
            'paymentMethodNonce' => $data['payment_Method_Nonce'],
            'options' => [
                'submitForSettlement' => true
                ]
            ]);
        } elseif ($promotionId == 2) {
        $result = $gateway->transaction()->sale([
            'amount' => '5.99',
            'paymentMethodNonce' => $data['payment_Method_Nonce'],
            'options' => [
                'submitForSettlement' => true
                ]
            ]);
        } elseif ($promotionId == 3) {
            $result = $gateway->transaction()->sale([
            'amount' => '9.99',
            'paymentMethodNonce' => $data['payment_Method_Nonce'],
            'options' => [
                'submitForSettlement' => true
                ]
            ]);
        }


    return view('checkout', compact('result'));
     // return response()->json($result);
    }
}
