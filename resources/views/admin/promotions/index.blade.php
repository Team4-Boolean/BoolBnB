@extends('layouts.app')
@section('content')
    <form class="" action="{{route('admin.promotions.store')}}"  method="post">
        @csrf
        @method('POST')
    <form>
    {{-- Promotions--}}
    <div class="form-check">
        <label for="promotions">Promozioni</label>
        @foreach ($promotions as $promotion)
            <div class="container-promotions-big">
               <div class="container-promotions-small">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="promotion{{$promotion->id}}">{{$promotion->name}}</label>
                        <input class="form-check-input"  type="checkbox" name="promotions[]" id="promotion{{$promotion->id}}" value="{{$promotion->id}}"
                        {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? 'checked' : ''}}>
                    </div>
                </div>
            </div>
        @endforeach
        @error('promotions')
            <span class='alert alert-danger'>
                {{$message}}
            </span>
        @enderror
    </div>
    {{-- House --}}
    <div class="form-check">
        <label for="$houses">House</label>
        @foreach ($houses as $house)
            <div class="container-promotions-big">
               <div class="container-promotions-small">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="promotion{{$house->id}}">{{$house->title}}</label>
                        <input class="form-check-input"  type="checkbox" name="houses[]" id="house{{$house->id}}" value="{{$house->id}}"
                        {{ (is_array(old('$houses')) && in_array($house->id, old('$houses'))) ? 'checked' : ''}}>
                   </div>
                </div>
            </div>
        @endforeach
        @error('house')
            <span class='alert alert-danger'>
                {{$message}}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-dark">Invia</button>
    </div>
@endsection
