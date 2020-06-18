@extends('layouts.app')
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
                <h2>Messages</h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Email contatto</th>
                <th>Iniviato alle</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>

                @foreach ($messages as $key => $message)
                {{-- POSSO VEDERE SOLO I MESSAGGI RIFERITI AI MIEI ANNUNCI Controllo Nr 2--}}
                 @if(Auth::id() == $message->house->user_id)
                    <tr>
                        <td>{{$message->email}}</td>
                        <td>{{$message->created_at}}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.messages.show', $message->id)}}">Visualizza</a></td>
                        <td>
                            <form action="{{route('admin.messages.destroy', $message->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Elimina">
                            </form>
                        </td>
                    </tr>
                 @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
