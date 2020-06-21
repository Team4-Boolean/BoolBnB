@extends('layouts.layout')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li id="mobile-none" class="breadcrumb-item active" aria-current="page">Messages</li>
                <li id="mobile-show" class="breadcrumb-item active" aria-current="page"> <a href="#">Messages</a></li>
            </ol>
        </nav>
        <div class="container-messages-index">

        <table class="table">
            <thead style: height= 56px>
                <th>Message from</th>
                <th class="mobile-none">Date</th>
                <th>Show</th>
                <th>Delete</th>
            </thead>
            <tbody>

                @foreach ($messages as $key => $message)
                {{-- POSSO VEDERE SOLO I MESSAGGI RIFERITI AI MIEI ANNUNCI Controllo Nr 2--}}
                 @if(Auth::id() == $message->house->user_id)
                    <tr>
                        <td class="view-message" data-id="{{ $message->id}}"> {{$message->email}} </td>
                        <td class="mobile-none">{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y')}}</td>
                        <span class="house-name" data-house="{{$message->house->title}}"></span>
                        {{-- <td><a class="btn btn-primary" href="{{route('admin.messages.show', $message->id)}}">Visualizza</a></td> --}}
                        <td class="view-message" data-id="{{ $message->id}}"><a class="btn btn-primary" >&#9863;</a></td>
                        <td>
                            <form action="{{route('admin.messages.destroy', $message->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="&#10007;">
                            </form>
                        </td>
                    </tr>
                 @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container-messages-show" data-messages='@php echo json_encode($messages); @endphp'>
        <div class="container-messages-top">
            <div class="messages-top-img">
                <img src="{{ asset('img/placeholder.png') }}" alt="">
            </div>
            <div class="messages-top-id">

            </div>
        </div>
        <div class="container-messages-body">
            <div class="body-left-messages">
                <div class="container-left-messages">

                </div>
            </div>
            <div class="body-right-messages">
                <div class="container-right-messages">

                </div>

            </div>
        </div>
        <div class="container-messages-bottom">
            <input class="messages-risp" type="text" name="" value="">
            <span class="button"> &#9998; </span>
        </div>
    </div>
    </div>
@endsection
