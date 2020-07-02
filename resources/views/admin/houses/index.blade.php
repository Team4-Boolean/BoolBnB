@extends('layouts.layout')
@section('content')
        <div class="col-12">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-6"><h3><a href="{{route('admin.promotions.index')}}">Sponsorizza una casa</a></h3></li>
                <li class="list-group-item col-6"><h3><a href="{{route('admin.houses.create')}}">Inserisci una nuova casa</a></h3></li>
            </ul>
            <ul id="sec" class="list-group list-group-horizontal ">
                <li class="list-group-item col-6"><h3><a href="{{route('admin.messages.index')}}">Visualizza i messaggi ricevuti</a></h3></li>
                <li class="list-group-item col-6"><h3><a href="{{route('admin.visitors.index')}}">Statistiche</a></h3></li>
            </ul>
            <div class="card mb-5">
                @foreach ($houses as $key => $house)
                @if(Auth::id() == $house->user_id)
                    <img src="{{asset('storage/' .$house->photo)}}" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$house->title}}</h5>
                        <p class="card-text">{{$house->description}}</p>
                        <a class="btn btn-primary" href="{{route('admin.houses.show', $house->id)}}">Visualizza</a>
                        <a class="btn btn-secondary" href="{{route('admin.houses.edit', $house->id)}}">Modifica</a>
                        <form action="{{route('admin.houses.destroy', $house->id)}}" method="POST" style="display: inline-block" >
                            @csrf
                            @method('DELETE')
                        <input class="btn btn-danger"type="submit" value="Elimina">
                     </form>
                    </div>
                @endif
                @endforeach
            </div>
            {{ $houses->links() }}
        </div>
@endsection
