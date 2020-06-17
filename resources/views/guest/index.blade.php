@extends('layouts.app')
@section('content')

    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item active" aria-current="page">Pages</li>
		    </ol>
        </nav>

        {{-- TUTTI POSSONO VEDERE LE CASE --}}
        <div class="row">
            <div class="col-5">
                <h2>Pages</h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>id</th>
                <th>Title</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>
                @foreach ($houses as $key => $house)
                    <tr>
                        <td>{{$house->id}}</td>
                        <td>{{$house->title}}</td>
                        <td><a class="btn btn-primary" href="{{route('houses.show', $house->id)}}">Visualizza</a></td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
