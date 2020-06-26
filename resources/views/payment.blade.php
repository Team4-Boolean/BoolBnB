@extends('layouts.app')

@section('content')
{{-- Payment --}}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="dropin-container">

            </div>
            <button id="submit-button">Request payment method</button>
        </div>
    </div>
</div>
<form name="form" action="{{route('payment.process')}}"  method="post">
    @csrf
    @method('POST')
<form>
<div class="form-group">
    <input type="hidden"  class="form-control" name="payment_Method_Nonce" id="nonce" placeholder="" value="">
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
