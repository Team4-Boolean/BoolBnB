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
                <h2>Pages</h2>
            </div>
            <div class="offset-3 col-2">
                <a href="{{route('admin.photos.create')}}">Aggiungi foto a un tuo appartamento</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>CASA</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>
                @foreach ($houses as $key => $house)
                    @foreach ($photos as $key => $photo)
                        <tr>
                            {{-- POSSO VEDERE SOLO GLI ANNUNCI PUBBLICATI DA ME --}}
                            @if($house->id == $photo->house_id)
                            <td>{{$house->title}}</td>
                            <td>{{$photo->name}}</td>
                            <td>{{$photo->description}}</td>
                            <td><a class="btn btn-secondary" href="{{route('admin.photos.edit', $photo->id)}}">Modifica</a></td>
                            <td><form action="{{route('admin.photos.destroy', $photo->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Elimina">
                           </form></tr>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
