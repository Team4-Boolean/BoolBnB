@extends('layouts.layout')
@section('content')
    <style>
        .container-adminHousesShow {
            background-image: url('{{asset('storage/' . $house->photo)}}');
            background-size: cover;

        }

    </style>
    <div class="container-adminHousesShow">
        <div class="card-ahs">
            <div class="row">
                <div class="col-12">
                    <div class="card-body-ahs">
                      <h3 class="card-title-ahs">{{$house->title}}</h3>
                      <p class="card-text-ahs">{{$house->description}}</p>
                    </div>
                    <div class="card-data-ahs">
                        <ul class="list-group">
                          <li class="list-group-item list-group-item-ahs">Indirizzo: {{$house->address}}</li>
                          <li class="list-group-item list-group-item-ahs">Stanze: {{$house->rooms}}</li>
                          <li class="list-group-item list-group-item-ahs">Letti: {{$house->beds}}</li>
                          <li class="list-group-item list-group-item-ahs">Bagni: {{$house->bathrooms}}</li>
                        </ul>
                        <div class="badges-ahs">
                            @foreach ($house->services as $key => $service)
                                <span class="badge">{{$service->name}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="{{route('admin.houses.edit', $house->id)}}" class="list-group-item">
                          Modifica appartamento
                        </a>
                        <a href="{{route('admin.promotions.index', $house->id)}}" class="list-group-item ">Attiva una promozione</a>
                        <a href="{{route('admin.photos.show', $house->id)}}" class="list-group-item ">Modifica Foto</a>
                        <a class="list-group-item d-flex justify-content-between align-items-center">
                            Messaggi ricevuti
                            <span class="badge badge-primary badge-pill">{{$message}}</span>
                        </a>
                        <a class="list-group-item d-flex justify-content-between align-items-center">
                            Visitatori
                            <span class="badge badge-primary badge-pill">{{$visitor}}</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
