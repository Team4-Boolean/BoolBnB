@extends('layouts.layout')
@section('content')
    <div class="container-welcome-empty">

    </div>
    <div class="container-welcome-top">

    </div>
    <div class="container-welcome-center">
        <div class="container-welcome-hello">
            <h1 data-aos="fade-down"
            data-aos-easing="linear"
            data-aos-duration="2000"> Benvenuto su <span> BoolBnB </span> &#174; </h1>
            <h4 data-aos="fade-down"
            data-aos-easing="linear"
            data-aos-duration="1800"> Il primo passo verso la tua vacanza inizia da qui </h4>
            <a class="btn btn-outline-info" href="{{route('houses.index')}}"> Entra &#9992; </a>
        </div>
        <div class="container-welcome-cit-maxwidth">
            <div class="container-welcome-cit-minwidth">
                <p> &#8246; Anche un viaggio di mille miglia inizia con un singolo passo &#8243; </p>
                <small> Lao Tzu </small>
            </div>
        </div>
    </div>
    <script>
      AOS.init();
    </script>
@endsection
