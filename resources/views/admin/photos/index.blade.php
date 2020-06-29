@extends('layouts.layout')
@section('content')
    <div class="container-AdminPhotosIndex">
        <div class="photo-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.houses.index')}}">I tuoi appartamenti</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tutte le tue foto</li>
                </ol>
            </nav>
            <div class="">
                <a class="btn btn-success" href="{{route('admin.photos.create')}}">Aggiungi una nuova foto</a>
            </div>

        </div>
        <div class="card-api">
            <div class="card-title">
                <h2>Le foto dei tuoi appartamenti</h2>
            </div>
        </div>
            <div class="card-photoContainer">
                @foreach ($houses as $key => $house)
                    @foreach ($photos as $key => $photo)
                            @if($house->id == $photo->house_id)
                                <div class="card-img">
                                    <h4>{{$house->title}}</h4>
                                    <img src="{{asset('storage/' .$photo->path)}}" alt="">
                                    {{$photo->name}}
                                    <div class="action-buttons">
                                        <a class="btn btn-warning" href="{{route('admin.photos.edit', $photo->id)}}">Modifica</a>
                                        <form action="{{route('admin.photos.destroy', $photo->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Elimina">
                                       </form>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
