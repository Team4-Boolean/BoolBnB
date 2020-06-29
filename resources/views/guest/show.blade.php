@extends('layouts.layout')
<script src="https://kit.fontawesome.com/dfd682ad78.js" crossorigin="anonymous"></script>
@section('content')
    <div class="container-GuestShowHouse">
        <div class="card-gsh">
            <div class="house-header">
                <div class="house-title">
                    <h2>{{$house->title}}</h2>
                </div>
                <div class="house-address">
                    <small>{{$house->address}}</small>
                </div>
            </div>
            <div class="house-photos">
                  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                         @foreach ($house->photos as $photo)
                            <div @if ($loop->first) class="carousel-item active" @else class="carousel-item" @endif>
                                <img src="{{asset('storage/' .$photo->path)}}" class="d-block w-100 img" alt="">
                                <div class="carousel-caption d-none d-md-block">
                                  <h4>{{$photo->name}}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>

            </div>
            <div class="prop-info">
                <h4>Appartamento affittato da {{$house->user->name}}</h4>
            </div>
            <div class="house-infos">
                <p>{{$house->rooms}} camere da letto - {{$house->beds}} posti letto - {{$house->bathrooms}} bagno/i</p>
            </div>

            <div class="separe"></div>

            <div class="house-desc">
                <p>{{$house->description}}</p>
            </div>

            <div class="house-services">
                <h4>Servizi</h4>
                <ul>
                    @foreach ($house->services as $service)
                        <li><i class="fas fa-check-circle"></i>{{$service->name}} {!!$service->service_icon!!}</li>
                    @endforeach
                </ul>
            </div>
<div class="house-footer">
            <div class="house-contact">
                <h4>Contatta l'host {{$house->user->name}}</h4>
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
                    <label for="email">Il tuo indirizzo email</label>
                    <input type="text"  class="form-control" name="email" placeholder="Enter email" id="email" value="@if (!empty(old('email'))) {{old('email')}} @elseif (Auth::check()) {{Auth::user()->email}} @endif">
                    @error('email')
                        <span class='alert alert-danger'>
                            {{$message}}
                        </span>
                    @enderror
                </div>

                {{-- BODY MESSAGE --}}
                <div class="form-group">
                    <label for="body">Messaggio</label>
                        <textarea type="text"  class="form-control" name="body" id="body" rows="10" placeholder="Enter Body" >{{old('body')}}</textarea>
                    @error('body')
                        <span class='alert alert-danger'>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Invia messaggio</button>
                </div>
            </div>
                <div class="maps">
                <div class="form-group card-custom">
                    <div id="map-example-container"></div>
                </div>
                <div class="search-hidden">
                        <input class="form-control" type="search" id="input-map" name="address" placeholder="Dove vuoi andare?" hidden> </input>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
                <script>
(function() {
  var latlng = {

    lat: {{$house->latitude}},
    lng: {{$house->longitude}}
  };
  console.log(latlng);

  var placesAutocomplete = places({
    appId: 'plHITMYHF3UE',
    apiKey: '61a6ce694b1ac511d9482961428abdf1',
    container: document.querySelector('#input-map')
  }).configure({
    aroundLatLng: latlng.lat + ',' + latlng.lng,
    aroundRadius: 10 * 1000, // 10km radius
    type: 'address'
  });

  var map = L.map('map-example-container', {
    scrollWheelZoom: false,
    zoomControl: true
  });

  var osmLayer = new L.TileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      minZoom: 12,
      maxZoom: 18,
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }
  );

  var markers = [];

  map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
  map.addLayer(osmLayer);

  placesAutocomplete.on('suggestions', handleOnSuggestions);
  placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
  placesAutocomplete.on('change', handleOnChange);

  function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
      return;
    }

    e.suggestions.forEach(addMarker);
    findBestZoom();
  }

  function handleOnChange(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          markers = [marker];
          marker.setOpacity(1);
          findBestZoom();
        } else {
          removeMarker(marker);
        }
      });
  }

  function handleOnClear() {
    map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
  }

  function handleOnCursorchanged(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          marker.setOpacity(1);
          marker.setZIndexOffset(1000);
        } else {
          marker.setZIndexOffset(0);
          marker.setOpacity(0.5);
        }
      });
  }

  function addMarker(suggestion) {
    var marker = L.marker(suggestion.latlng, {opacity: .4});
    marker.addTo(map);
    markers.push(marker);
  }

  function removeMarker(marker) {
    map.removeLayer(marker);
  }

  function findBestZoom() {
    var featureGroup = L.featureGroup(markers);
    map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
  }
})();
</script>
</div>

        </div>
    </div>
@endsection
