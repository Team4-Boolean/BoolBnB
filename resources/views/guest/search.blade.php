@extends('layouts.layout')
@section('content')
	<div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item active" aria-current="page">Pages</li>
		    </ol>
        </nav>

        {{-- TUTTI POSSONO VEDERE LE CASE --}}
        <div class="row">
            <div class="col-5">
                <h2>Pages</h2>
            </div>
        </div>
        <form class="" action=""  method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
        <form>
        <div class="form-group">
                <label for="address">Address</label>
                <input type="search" id="address" name="address" placeholder="Where are we going?"> </input>
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
            <button type="button" id="tasto" class="btn btn-dark">Invia</button>
        </div>
    </div>
@endsection
