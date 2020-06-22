@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page"><a href="{{route('houses.index')}}">Messages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$house->summary}}</li>
                    </ol>
                </nav>
            </div>
        </div>


      {{-- MOSTRO TUTTI I DATI DELLA CASA --}}
        <div class="row">
            <div class="col-12">
                <h2>{{$house->title}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
              {!! $house->description !!}
             </div>
        </div>
        <img src="{{asset('storage/' . $house->photo)}}" alt="">

        {{-- CREO IL MESSAGGIO DA INVIARE A CHI HA FATTO LA CASA --}}

        <form class="" action="{{route('save_message')}}"  method="post">
            @csrf
            @method('POST')
        <form>

       {{-- ID UTENTE (HIDDEN)--}}
        <div class="form-group">
            <input type="hidden"  class="form-control" name="house_id" id="house_id" placeholder="Enter Title" value="{{$house->id}}">
        </div>

        {{-- EMAIL --}}
        <div class="form-group">
            <label for="email">email</label>
            <input type="text"  class="form-control" name="email" placeholder="Enter email" id="email" value="@if (!empty(old('email'))) {{old('email')}} @elseif (Auth::check()) {{Auth::user()->email}} @endif">
            @error('email')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- BODY MESSAGE --}}
        <div class="form-group">
            <label for="body">Message</label>
                <textarea type="text"  class="form-control" name="body" id="body" rows="10" placeholder="Enter Body" >{{old('body')}}</textarea>
            @error('body')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark">Invia</button>
        </div>
    </div>
@endsection
