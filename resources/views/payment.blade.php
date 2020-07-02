@extends('layouts.layout')
@section('content')

{{-- Payment --}}

    <div class="container-payment-maxwidth">
        <div class="container-payment-empty">

        </div>
        <div class="container-payment-form">
            <h2> Insersci un metodo di pagamento </h2>
            <div id="dropin-container">

            </div>
            <button type="button" class="btn btn-success" id="submit-button"> Conferma e attiva la promo </button>
            <form name="form" action="{{route('payment.process')}}"  method="post">
                @csrf
                @method('POST')
            <form>
            <div class="form-group">
                <input type="hidden"  class="form-control" name="payment_Method_Nonce" id="nonce" placeholder="" value="">
            </div>
        </div>
    </div>

<script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
        authorization: 'sandbox_w3jyvc65_j5kyxqgqgmc7d65n',
        container: '#dropin-container'
        }, function (err, instance) {
            button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
@endsection
