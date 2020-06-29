@extends('layouts.layout')
@section('content')
    {{-- Porto la data di scadenza della promo dal mio controller --}}
    <?php $activatePromo = Session::get('activatePromo'); ?>

    {{-- Payment --}}
    <div class="container-payment-empty">

    </div>
    <div class="container-payment-maxwidth">
        <div class="container-payment-form">
            <h4>  Metti in evidenza la tua casa fino al {{Carbon\Carbon::parse($activatePromo)->format('d-m-Y')}}</h4>
            <h2> Paga € {{$promotion->price}} </h2>
            <div id="dropin-container">

            </div>
                <form name="form" action="{{route('payment.process')}}"  method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <input type="hidden"  class="form-control" name="payment_Method_Nonce" id="nonce" placeholder="">
                    <input type="hidden"  class="form-control" name="promotion" id="promotion" value="{{ $promotion->id }}">

                </div>
                <button type="button" class="btn btn-success" id="submit-button"> Conferma e attiva la promo </button>
                </form>
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
