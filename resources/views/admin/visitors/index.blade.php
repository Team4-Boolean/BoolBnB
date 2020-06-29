@extends('layouts.layout')
@section('content')

    <div class="container-visitors-js-empty">

    </div>
    {{-- Invio i dati della tabella dei vistatori --}}
    <div class="container-visitors-js" data-visitors='@php echo json_encode($visitors); @endphp'>
        <div class="container-visitors-grafico" style="position: relative; height:500px; width:800px"
        data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"
     data-aos-duration="2000">
            <canvas id="grafico-visitors"></canvas>
        </div>
    </div>

    <script>
      AOS.init();
    </script>
@endsection
