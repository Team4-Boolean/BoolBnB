@extends('layouts.layout')
@section('content')
    <div class="container-promotion-activate-empty">

    </div>
    <div class="container-promotion-activate-maxwidth">
        <div class="container-promotion-activate-minwidth">
            <h1 data-aos="flip-left"
                data-aos-duration="1500"> Pagamento effettuato con successo! </h1>
            <a href="{{route('admin.houses.index')}}"class="btn btn-outline-success"> Torna alla tua dashboard </a>
        </div>
    </div>


    <script>
         AOS.init();
    </script>
@endsection
