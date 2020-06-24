@extends('layouts.app')
@section('content')
    {{-- TAGS --}}
    <div class="form-check">
        <label for="promotions">Promozioni</label>
        @foreach ($promotions as $promotion)
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="promotion{{$promotion->id}}">{{$promotion->name}}</label>
            <input class="form-check-input"  type="checkbox" name="promotion[]" id="promotion{{$promotion->id}}" value="{{$promotion->id}}"
             {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? 'checked' : ''}}>
        </div>
        @endforeach
        @error('promotions')
            <span class='alert alert-danger'>
                {{$message}}
            </span>
        @enderror
    </div>
@endsection
