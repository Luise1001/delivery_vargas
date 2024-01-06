@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home/style.css') }}">
@endsection

@section('messages')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">CALCULADORA</div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="calculator">
            <label class='form-label' for="tipo_servicio">Tipo de Servicio</label>
            <div class='input-group'>
                <select class='form-select calculator-select' id='tipo_servicio' name='tipo_servicio'>
                    <option value='1'>Delivery</option>
                </select>
            </div>
            <label class='form-label' for='from'>Punto de Partida<span class="text-danger">*</span></label>
            <input class='form-control calculator-input' type='text' id='from' name='from'
                placeholder="Punto de partida">
            <label class='form-label' for='to'>Destino<span class="text-danger">*</span></label>
            <input class='form-control calculator-input' type='text' id='to' name='to' placeholder="Destino">

            <div class="calcular-buttons">
                <button id='calcular' class='calcular'>Calcular</button>
            </div>


            <div class="calculator-map">
                <div id="googleMap"></div>
            </div>

            <div id="output">
                <label class='form-label' for="salida">Punto de Partida:</label>
                <div class='output' id="salida"></div>
                <label class='form-label' for="destino">Destino:</label>
                <div class='output' id="destino"></div>
                <label class='form-label' for="distancia">Distancia:</label>
                <div class='output' id="distancia"></div>
                <label class='form-label' for="tiempo">Tiempo:</label>
                <div class='output' id="tiempo"></div>
                <label class='form-label' for="tarifa">Total a Pagar:</label>
                <div class='output' id="tarifa"></div>
            </div>

        </div>
    @endsection

    @section('javascripts')
        <script src=" {{ asset('assets/js/home/maps/geocoding.js') }} "></script>
        <script src=" {{ asset('assets/js/home/maps/autocomplete.js') }} "></script>
        <script src=" {{ asset('assets/js/home/maps/routes.js') }} "></script>
        <script src=" {{ asset('assets/js/home/maps/calculator.js') }} "></script>

        <script>
            function calctarifa(distance) {
                let service = $('#tipo_servicio').val();

                const tarifa = $.ajax({
                        url: "{{ route('calculator.fee') }}",
                        type: 'POST',
                        async: true,
                        dataType: 'html',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            distance: distance,
                            service: service
                        }

                    })
                    .done(function(res) {
                        return res;
                    })
                    .fail(function(err) {
                        console.log(err);
                    })

                return tarifa;
            }
        </script>
    @endsection
