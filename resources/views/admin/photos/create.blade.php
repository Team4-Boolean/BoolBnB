@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.photos.index')}}">photos</a></li>
              <li class="breadcrumb-item active" aria-current="page">create</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
        <form action="{{route('admin.photos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                  <label for="house">Seleziona la casa a cui vuoi aggiungere la foto</label>
                  <select name="house_id" id="house_id" class="custom-select">
                    @foreach ($houses as $house)
                      <option value="{{$house['id']}}">{{$house['title']}}</option>
                    @endforeach
                  </select>
                  @error('house')
                    <small class="form-text">Errore</small>
                  @enderror
                </div>
             <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name"  placeholder="Inserisci un titolo" name="name">
                @error('name')
                  <small class="form-text">Errore</small>
                @enderror
              </div>
             <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description"  placeholder="Inserisci una descrizione"  name="description">
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
                 <input class="btn btn-primary" type="submit" value="Salva">
               </div>
          </form>
        </div>
      </div>
    </div>
@endsection
