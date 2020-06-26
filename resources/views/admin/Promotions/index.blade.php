@extends('layouts.app')
@section('content')
    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.js"></script>

    <form name="form"action="{{route('admin.checkout.store')}}" method="post">
        @csrf
        @method('POST')
        <input hidden id="nonce" type="text" name="payment_Method_Nonce"><br>
        <input type="submit">
    </form>



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
    <script type="text/javascript">
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
    authorization: 'sandbox_5rmpznq2_vg32wyyg6tx5pq2t',
    selector: '#dropin-container'
    }, function (err, instance) {
    button.addEventListener('click', function () {
    instance.requestPaymentMethod(function (err, payload) {
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
    });
    });
    });

      // Submit payload.nonce to your server
    </script>

    {{-- @php
        $nonceFromTheClient = $_POST["paymentMethodNonce"];
        /* Use payment method nonce here */
        $result = $gateway->transaction()->sale([
          'amount' => '10.00',
          'paymentMethodNonce' => $test,
          'options' => [
            'submitForSettlement' => True
          ]
        ]);
        dd($result);
    @endphp --}}


@endsection
