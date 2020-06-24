@extends('layouts.layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
<script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.houses.index')}}">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>

        <form class="" action="{{route('admin.houses.store')}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
        <form>

        {{-- VISIBLE/NOT VISIBLE --}}
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible">
                <label class="custom-control-label" for="customSwitches">Visible</label>
            </div>
        </div>

        {{-- TITLE --}}
        <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" >{{old('title')}}</input>
            @error('title')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- DESCRIPTION --}}
        <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="description" id="description" rows="10" placeholder="Enter Description" >{{old('description')}}</textarea>
            @error('description')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- ROOMS --}}
        <div class="form-group">
                <label for="rooms">Rooms</label>
                <input type="text" class="form-control" name="rooms" id="rooms" placeholder="Enter Rooms" value="{{old('rooms')}}"></input>
            @error('rooms')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- BATHROOMS --}}
        <div class="form-group">
                <label for="bathrooms">Bathrooms</label>
                <input type="text" class="form-control" name="bathrooms" id="bathrooms" placeholder="Enter Bathrooms" value="{{old('bathrooms')}}"></input>
            @error('bathrooms')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- BEDS --}}
        <div class="form-group">
                <label for="beds">Beds</label>
                <input type="text" class="form-control" name="beds" id="beds" placeholder="Enter Beds" value="{{old('beds')}}"></input>
            @error('beds')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- MQ --}}
        <div class="form-group">
                <label for="mq">MQ</label>
                <input type="text" class="form-control" name="mq" id="mq" placeholder="Enter Mq" value="{{old('mq')}}"></input>
            @error('mq')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- ADDRESS --}}
        <div class="form-group">
                <label for="address">Address</label>
                <input type="search" id="address-map" name="address" placeholder="Where are we going?"> </input>
                {{-- <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{old('address')}}"></input> --}}
            @error('address')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        <div id="map-example-container"></div>
        <style>
          #map-example-container {height: 100px};
        </style>

        {{-- LONG --}}
        <div class="form-group">
                <input type="hidden" class="form-control" name="longitude" id="longitude"></input>
        </div>
        {{-- LAT --}}
        <div class="form-group">
                <input type="hidden" class="form-control" name="latitude" id="latitude"></input>
        </div>

        {{-- PHOTO --}}
        {{-- @foreach ($photos as $key => $photo)
            <img src="{{asset('storage/' .$photo->path)}}" alt="">
        @endforeach --}}
        <div class="form-group">
            <label for="photos">Seleziona un immagine di copertina</label>
            <div class="custom-file">
              <input multiple type="file" class="custom-file-input" id="inputGroupFile01" name="photos[]">
              <label class="custom-file-label" for="inputGroupFile01">Browse</label>
            </div>
            @error('photo')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

        {{-- TAGS --}}
        <div class="form-check">
            <label for="services">Services</label>
            @foreach ($services as $service)
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="service{{$service->id}}">{{$service->name}}</label>
                <input class="form-check-input"  type="checkbox" name="services[]" id="service{{$service->id}}" value="{{$service->id}}"
                 {{ (is_array(old('services')) && in_array($service->id, old('services'))) ? 'checked' : ''}}>
            </div>
            @endforeach
            @error('services')
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
