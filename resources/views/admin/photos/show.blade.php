@extends('layouts.layout')
@section('content')
    {{-- <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
             <li class="breadcrumb-item active" aria-current="page">Pages</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-5">
                <h2>Photos</h2>
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
                    @foreach ($photos as $key => $photo)
                        <tr>
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
            </tbody>
        </table>
    </div> --}}
    <div class="container-AdminPhotosIndex">
        <div class="photo-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.houses.index')}}">Le tue case</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.houses.show', $house->id)}}">{{$house->title}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Foto dell'appartamento</li>
                </ol>
            </nav>
            <div class="">
                <a class="btn btn-success" href="{{route('admin.photos.create')}}">Aggiungi una nuova foto</a>
            </div>

        </div>
        <div class="card-api">
            <div class="card-title">
                <h2>Le foto di: {{$house->title}}</h2>
            </div>
            <div class="card-photoContainer">
                    @foreach ($photos as $key => $photo)
                            @if($house->id == $photo->house_id)
                                <div class="card-img">
                                    <h4>{{$photo->name}}</h4>
                                    <img src="{{asset('storage/' .$photo->path)}}" alt="">
                                    {{$photo->description}}
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
            </div>
        </div>
    </div>
@endsection
