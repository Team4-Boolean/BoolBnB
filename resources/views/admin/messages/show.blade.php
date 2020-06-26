{{-- MOSTRA IL TESTO DEI MESSAGGI --}}
@extends('layouts.layout')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('admin.messages.index')}}"> Messages</a></li>
            </ol>
        </nav>
            <h1>MESSAGGIO RICEVUTO:</h1>
            <h2>Testo del messaggio:</h2>
            <h2>{{$message->body}}</h2>

            <h3>Messaggio riferito al tuo annuncio numero {{$message->house_id}}</h3>
@endsection
