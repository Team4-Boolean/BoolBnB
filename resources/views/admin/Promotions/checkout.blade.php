@extends('layouts.app')
@section('content')
    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.js"></script>

    @php
    $gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'vg32wyyg6tx5pq2t',
    'publicKey' => '7cnmmwj3p39gjd2v',
    'privateKey' => '1e8e3b8723ab6967edd04176abfafe41'
    ]);
    @endphp

    {{-- @php
        echo($clientToken = $gateway->clientToken()->generate());
    @endphp --}}

    <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button>


    @php
        $nonceFromTheClient = $data['payment_Method_Nonce'];
        /* Use payment method nonce here */
        $result = $gateway->transaction()->sale([
          'amount' => '10.00',
          'paymentMethodNonce' => $nonceFromTheClient,
          'options' => [
            'submitForSettlement' => True
          ]
        ]);
        dd($result);
    @endphp


@endsection
