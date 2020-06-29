@extends('layouts.layout')
@section('content')
    <div class="container-promotions-empty">

    </div>
    <div class="offset-1 col-10 container-promotions">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.houses.index')}}"> Houses </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Promotions </li>
            </ol>
        </nav>
        <div class="promotions-cit">
            <h3> Metti in risalto la tua casa con una sponsorizzazione! </h3>
        </div>
        <form class="" action="{{route('admin.promotions.store')}}"  method="post" >
            @csrf
            @method('POST')
        <form>
        {{-- Promotions--}}
        <div class="form-check">
            <label class="promotions-title" for="promotions"> Scegli la promo: </label>
            @foreach ($promotions as $promotion)
                <div class="container-promotions-big">
                   <div class="container-promotions-small">
                        <label class="form-check-label promotions-body" for="promotion{{$promotion->id}}"
                               data-aos="fade-right"
                               data-aos-duration="1500">{!!$promotion->name!!} &#10030;</label>
                        <input class="form-check-input promotions-checkbox"
                               data-aos="fade-right"
                               data-aos-duration="1500"  type="radio" name="promotion_id" id="promotion{{$promotion->id}}" value="{{$promotion->id}}"
                        {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? 'checked' : ''}}>
                    </div>
                </div>
            @endforeach
            @error('promotions')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- Houses --}}
        <div class="form-check">
            <label class="promotions-title" for="houses"> Seleziona una casa: </label>
            @foreach ($houses as $house)
                <div class="container-promotions-big">
                       <div class="container-promotions-small">
                        <label class="form-check-label promotions-body" for="promotion{{$house->id}}">{{$house->title}}</label>
                        <input class="form-check-input promotions-checkbox"  type="radio" name="house_id" id="house{{$house->id}}" value="{{$house->id}}"
                        {{ (is_array(old('$houses')) && in_array($house->id, old('$houses'))) ? 'checked' : ''}}>
                    </div>
                </div>
            @endforeach
            @error('house')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>

            {{-- <button type="button" class="btn btn-outline-success"> <a href="{{route('payment')}}"> Procedi al pagamento &dollar; </a></button> --}}
        <div class="form-group promotions-send-button">
            {{-- <a href="{{route('payment')}}"> Procedi al pagamento &dollar; </a> --}}
            <button type="submit" class="btn btn-outline-success promotions-button"> Procedi al pagamento &#9745;</button>
        </div>
    </div>

    <script>
      AOS.init();
    </script>
@endsection
