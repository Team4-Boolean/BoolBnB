@extends('layouts.layout')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
             <li class="breadcrumb-item active" aria-current="page">Pages</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-5">
                <h2> Houses </h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>
                @foreach ($houses as $key => $house)
                    <tr>
                        {{-- POSSO VEDERE SOLO GLI ANNUNCI PUBBLICATI DA ME --}}
                        @if(Auth::id() == $house->user_id)
                        <td>#{{$house->id}}</td>
                        <td>{{$house->title}}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.houses.show', $house->id)}}">Visualizza</a></td>
                        <td><a class="btn btn-secondary" href="{{route('admin.houses.edit', $house->id)}}">Modifica</a></td>
                        <td><form action="{{route('admin.houses.destroy', $house->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Elimina">
                       </form></tr>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row" style="margin: 50px 0;">
        <div class="offset-2 col-4 go-to-promotions">
            <button type="button" class="btn btn-outline-warning"><a href="{{route('admin.promotions.index')}}"> <h3> Sponsorizza una casa </h3></a></button>
        </div>
        <div class="offset-1 col-4" >
            <button type="button" class="btn btn-outline-success"><a href="{{route('admin.houses.create')}}"> <h3> Inserisci una nuova casa </h3> </a></button>
        </div>
    </div>
@endsection
