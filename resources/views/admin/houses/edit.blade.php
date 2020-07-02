@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center custom-margin">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-nav">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.houses.index')}}">Le tue case</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifica annuncio</li>
            </ol>
        </nav>
    </div>
    <div class="card-container-CreateHouses">
        <div class="">
            <div class="row justify-content-center">
                <div class="bg-light card w-75">
                    <form class="" action="{{route('admin.houses.update',$house->id)}}"  method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    <form>

                    {{-- VISIBLE/NOT VISIBLE --}}
                    <div class="form-group card-header card-header-custom">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible" value="{{old('visible') ?? $house->visible}}" {{ $house->visible ? 'checked': '' }}>

                            <label class="custom-control-label" for="customSwitches">Visibilità annuncio</label>
                        </div>
                    </div>
                    {{-- TITLE --}}
                    <div class="form-group card-custom">
                            <label for="title">Nome</label>
                            <input type="text" value="{{old('title') ?? $house->title}}" class="form-control" name="title" id="title" placeholder="Nome appartamento" ></input>
                        @error('title')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- DESCRIPTION --}}
                    <div class="form-group card-custom">
                            <label for="description">Descrizione</label>
                            <textarea type="text" class="form-control" name="description" id="description" rows="10" placeholder="Descrizione" >{{old('description') ?? $house->description}}</textarea>
                        @error('description')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- ROOMS --}}
                    <div class="form-group card-custom">
                            <label for="rooms">Numero stanze</label>
                            <input type="text" class="form-control" name="rooms" id="rooms" placeholder="Numero stanze" value="{{old('rooms') ?? $house->rooms}}"></input>
                        @error('rooms')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- BATHROOMS --}}
                    <div class="form-group card-custom">
                            <label for="bathrooms">Bagni</label>
                            <input type="text" class="form-control" name="bathrooms" id="bathrooms" placeholder="Numero bagni" value="{{old('bathrooms') ?? $house->bathrooms}}"></input>
                        @error('bathrooms')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- BEDS --}}
                    <div class="form-group card-custom">
                            <label for="beds">Posti letto</label>
                            <input type="text" class="form-control" name="beds" id="beds" placeholder="Posti letto" value="{{old('beds') ?? $house->beds}}"></input>
                        @error('beds')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- MQ --}}
                    <div class="form-group card-custom">
                            <label for="mq">Metri quadrati</label>
                            <input type="text" class="form-control" name="mq" id="mq" placeholder="Metri quadrati" value="{{old('mq') ?? $house->mq}}"></input>
                        @error('mq')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- ADDRESS --}}
                    <div class="form-group card-custom">
                        <div id="map-example-container"></div>
                        <style>
                          #map-example-container {height: 100px};
                        </style>
                    </div>
                    <div class="form-group card-custom">
                            <label for="address">Indirizzo</label>
                            <input class="form-control" type="search" id="address" name="address" placeholder="Dove vuoi andare?" value="{{old('mq') ?? $house->mq}}"> </input>
                        @error('address')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    {{-- LONG --}}
                    <div class="form-group card-custom">
                         <input type="hidden" class="form-control" name="longitude" id="longitude"></input>
                    </div>

                    {{-- LAT --}}
                    <div class="form-group card-custom">
                        <input type="hidden" class="form-control" name="latitude" id="latitude"></input>
                    </div>

                    {{-- PHOTO --}}
                    <div class="form-group card-custom">
                        <label for="photo">Seleziona un immagine di copertina</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="photo">
                          <label class="custom-file-label" for="inputGroupFile01">Seleziona un file</label>
                        </div>
                        @error('photo')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group card-custom">
                        <img class="img-fluid" src="{{asset('storage/' .$house->photo)}}" alt="" >
                    </div>
                    <div class="form-group card-custom">
                        <a href="{{route('admin.photos.show', $house->id)}}" class="btn btn-primary">Modifica altre foto</a>
                    </div>


                    {{-- TAGS --}}
                    <div class="form-group card-custom">
                        <label class="card-custom" for="services">Servizi aggiuntivi</label>
                        @foreach ($services as $service)
                        <div>
                            <div class="form-check form-check-inline card-custom">
                                <input class="form-check-input"  type="checkbox" name="services[]" id="service{{$service->id}}" value="{{$service->id}}"
                                  {{((is_array(old('services')) && in_array($service->id, old('services'))) || $house->services->contains($service->id)) ? 'checked' : ''}}>
                                  <label class="form-check-label" for="service{{$service->id}}">{{$service->name}} {!!$service->service_icon!!}</label>
                            </div>
                        </div>
                        @endforeach
                        @error('services')
                            <span class='alert alert-danger'>
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                    {{-- BUTTON --}}

                    <div class="form-group card-custom text-center">
                        <button type="submit" class="btn btn-success">Modifica annuncio
                            <svg class="bi bi-check" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
