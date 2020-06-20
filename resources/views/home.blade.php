@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="create">
        <h1>Inserisci il tuo primo annuncio</h1>
            <a class="btn btn-primary" href="{{route('admin.houses.create')}}">Crea</a>
        <h1>O cerca la tua casa </h1>
            <a class="btn btn-primary" href="{{route('houses.index')}}">Crea</a>
    </div>
</div>
@endsection
