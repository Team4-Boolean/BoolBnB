@extends('layouts.layout')
@section('content')
    <h1>{{$house->title}}</h1>
    <h3>{{$house->description}}</h3>
    <img src="{{asset('storage/' . $house->photo)}}" alt="">
        @foreach ($house->services as $service)
            <p>{{$service->name}}</p>
        @endforeach

    {{-- VISUALIZZO QUANTI MESSAGGI IN TOTALE MI SONO ARRIVATI PER QUESTA CASA (Da admin) --}}
    <div class="row">
        <div class="col-12">
            <h2 style= color:red >Ha ricevuto {{$message}} messaggi per questa casa</h2>
        </div>
    </div>
@endsection
