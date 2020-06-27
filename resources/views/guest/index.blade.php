@extends('layouts.layout')
@section('content')
<div class="container-home-index">
    <form class="" action="{{route('houses.store')}}"  method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
    <form>
    <div class="form-group">
          <input type="search" id="address-map" name="address" placeholder="Where are we going?"> </input>
    </div>
    {{-- LONG --}}
    <div class="form-group">
          <input type="hidden" class="form-control" name="longitude" id="longitude"></input>
    </div>
    {{-- LAT --}}
    <div class="form-group">
          <input type="hidden" class="form-control" name="latitude" id="latitude"></input>
    </div>
    <div class="form-group">
      <button type="submit" id="dio" class="btn btn-dark">Invia</button>
    </div>
    <div class="title-home-index">
        <h2>Appartamenti in evidenza</h2>
    </div>
        <div class="centered">
            <section class="cards-home-index">
                @foreach ($promotions as $key => $promotion)
                    @foreach ($promotion->houses as $house)
                        <div class="card-home-index">
                            <a href="{{route('houses.show', $house->id)}}">
                                <picture class="thumbnail">
                                    <img src="{{asset('storage/' .$house->photo)}}">
                                </picture>
                                <div class="card-content">
                                    <h2>{{$house->title}}</h2>
                                    <p>{{$house->description}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </section>
        </div>
    </div>
@endsection
