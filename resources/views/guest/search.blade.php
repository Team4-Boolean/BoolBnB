@extends('layouts.layout')
@section('content')
<div class="container-home-index chi-search">
    <div class="centered searchs-container">
        <form class="form-inline searchs" action="{{route('houses.store')}}"  method="post" enctype="multipart/form-data">
              @csrf
              @method('POST')
        <form>
        <div class="input-group col-8">
              <input class="" type="search" id="address" value="" name="address" placeholder="Dove vuoi andare?"></input>
        </div>
        <div class="input-group col-3">
          <button type="button" id="tasto" class="btn btn-primary">Cerca</button>
        </div>
        {{-- LONG --}}
        <div class="form-group">
              <input type="hidden" class="form-control" name="longitude" id="longitude"></input>
        </div>
        {{-- LAT --}}
        <div class="form-group">
              <input type="hidden" class="form-control" name="latitude" id="latitude"></input>
        </div>
        <div class="search-view-filters">
            <div class="swfilters">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="" role="presentation">
                    <a class="nav-link" id="radius-tab" data-toggle="tab" href="#radius" role="tab" aria-controls="radius" aria-selected="true">Raggio di ricerca</a>
                  </li>
                  <li class="" role="presentation">
                    <a class="nav-link" id="rooms-tab" data-toggle="tab" href="#rooms" role="tab" aria-controls="rooms" aria-selected="false">Stanze e posti letto</a>
                  </li>
                  <li class="" role="presentation">
                    <a class="nav-link" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="false">Servizi</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="radius" role="tabpanel" aria-labelledby="radius-tab">
                        <div class="swstep">
                            <h5>Distanza in Km <span id="outputSlider" class="badge badge-primary"></span></h5>
                            <input type="range" class="custom-range" min="0" max="250" step="10" value={{$radius}} id="myRange">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
                        <label for="">Stanze</label>
                        <input class="form-control-sm" type="number" value="1" min="1" max="25" step="1"/>
                        <label for="">Posti Letto</label>
                        <input class="form-control-sm" type="number" value="1" min="1" max="25" step="1"/>
                    </div>
                    <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                        <div class="form-check">
                            @foreach ($services as $service)
                                <input class="form-check-input"   type="checkbox" id="{{$service->id}}"  value="{{$service->id}}">
                                <label class="form-check-label"   for="{{$service->id}}">{{$service->name}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="centered">
        <div class="title-home-index searchs-sr">
            <h2>Appartamenti in evidenza</h2>
        </div>
        <div class="cards-home-index">
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
        </div>
        <div class="title-home-index searchs-sr">
            <h2>Appartamenti</h2>
        </div>
        <div id="js-cards" class="cards-home-index">
            @foreach ($houses as $key => $house)
                <div id="js-card" class="card-home-index">
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
        </div>
        <script id="card-template-search" type="text/x-handlebars-template">
            <div id="js-card" class="card-home-index" data-rooms = "@{{rooms}}" data-beds ="@{{beds}}" data-services ="@{{services}}" >
                <a href="">
                    <picture class="thumbnail">
                        <img src="{{asset('storage/')}}">
                    </picture>
                    <div class="card-content">
                        <h2>@{{title}}</h2>
                        <p>@{{description}}</p>
                    </div>
                </a>
            </div>
        </script>
    </div>
@endsection
