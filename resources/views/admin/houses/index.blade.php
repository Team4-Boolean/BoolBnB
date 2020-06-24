@extends('layouts.app')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
             <li class="breadcrumb-item active" aria-current="page">Houses</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-5">
                <h2>Pages</h2>
            </div>
            <div class="offset-3 col-2">
                <a href="{{route('admin.houses.create')}}">Crea una pagina</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th colspan="4">Action</th>
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
    <div class="offset-3 col-2">
        <a href="{{route('admin.promotions.index')}}" style="color:red"> <h3> Sponsorizza una casa </h13></a>
    </div>
@endsection
