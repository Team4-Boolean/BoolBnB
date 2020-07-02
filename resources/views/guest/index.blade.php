@extends('layouts.layout')
@section('content')
<div class="container-home-index">
    <div class="centered searchs-container">
        <form class="form-inline searchs" action="{{route('houses.store')}}"  method="post" enctype="multipart/form-data">
              @csrf
              @method('POST')
        <form>
        <div class="input-group col-8">
              <input class="" type="search" id="address" name="address" value="" placeholder="Dove vuoi andare?"> </input>
        </div>
        <div class="input-group col-2">
          <button type="submit" id="address-btn-index" class="btn btn-primary">Cerca</button>
        </div>
        {{-- LONG --}}
        <div class="form-group">
              <input type="hidden" class="form-control" name="longitude" id="longitude"></input>
        </div>
        {{-- LAT --}}
        <div class="form-group">
              <input type="hidden" class="form-control" name="latitude" id="latitude"></input>
        </div>
    </div>
    <div class="centered">
        <div class="title-home-index searchs">
            <h2>Appartamenti in evidenza</h2>
        </div>
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
