@extends('layouts.app')
@section('content')
    <h1>{{$house->title}}</h1>
    <h3>{{$house->description}}</h3>
    <img src="{{$house->photo}}" alt="">
        @foreach ($house->services as $service)
            <p>{{$service->name}}</p>
        @endforeach
@endsection
