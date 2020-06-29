@extends('layouts.app')
@section('content')
    <div class="container-AdminPhotosEdit">
        <div class="photo-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url()->previous()}}">Tutte le foto</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$photo->name}}</li>
                </ol>
            </nav>
        </div>
        <div class="card-ape">
            <div class="card-title">
                <h2>Modifca e aggiorna la foto</h2>
            </div>
        <img src="{{asset('storage/' .$photo->path)}}"class="img img-fluid" alt="">
      <div class="row">
        <div class="col-12">
        <form action="{{route('admin.photos.update', $photo->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

             <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name"  placeholder="Inserisci un titolo" name="name" value="{{old('name') ?? $photo->name}}">
                @error('name')
                  <small class="form-text">Errore</small>
                @enderror
              </div>
             <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description"  placeholder="Inserisci una descrizione"  name="description" value="{{old('name') ?? $photo->description}}">
                @error('description')
                  <small class="form-text">Errore</small>
                @enderror
              </div>
             <div class="form-group">

                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" name="path">
                  <label class="custom-file-label" for="inputGroupFile01">Browse</label>
                </div>
                @error('path')
                  <small class="form-text">Errore</small>
                @enderror
              </div>

               <div class="form-group">
                 <input class="btn btn-primary" type="submit" value="Aggiorna">
               </div>
          </form>
        </div>
      </div>
    </div>
@endsection
