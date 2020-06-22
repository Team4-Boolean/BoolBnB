@extends('layouts.app')
@section('content')
    <h1>{{$house->title}}</h1>
    <h3>{{$house->description}}</h3>
    <img src="{{asset('storage/' . $house->photo)}}" alt="">
        @foreach ($house->services as $service)
            <p>{{$service->name}}</p>
        @endforeach

    {{-- Visualizzo in totale quanti messaggi mi sono arrivati per questa casa (Da admin) --}}
    {{-- Se ne ricevo 1, stampo "messaggio" al singolare --}}
    @if ($message == 1)
        <div class="row">
            <div class="col-12">
                <h2 style= color:red >Ha ricevuto {{$message}} messaggio per questa casa</h2>
            </div>
        </div>
    {{-- Se ne ricevo 0, o più di 1, stampo "messaggi" al plurale --}}
    @elseif ($message == 0 || $message > 1)
        <div class="row">
            <div class="col-12">
                <h2 style= color:red >Ha ricevuto {{$message}} messaggi per questa casa</h2>
            </div>
        </div>
    @endif
@endsection
