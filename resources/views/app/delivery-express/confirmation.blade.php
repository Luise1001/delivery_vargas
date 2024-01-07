@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/delivery-express/style.css') }}">
@endsection

@section('messages')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">
        <button class="back-button" onclick=history.back()><i class="fa-solid fa-arrow-left"></i></button>
        CONFIRMACIÓN
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="delivery-express">
            <form hidden id="confirm_form" action="{{ route('delivery.express.store') }}" method="post">
                @csrf
                <input type="text" name="service_id" value="{{ $request->service_id }}">
                <input type="text" name="type" value={{ $request->type }}>
                <input type="text" name="route" value="{{ $request->route }}">
                <input type="text" name="amount" value="{{ $price }}">
                <input type="text" name="comment" value="{{ $request->comment }}">
            </form>
            <label class="form-label" for="service_id">Tipo de Servicio</label>
            <div class="content-text">{{ $service->name }}</div>

            <label class="form-label" for="type">Tipo de Solicitud</label>
            <div class="content-text">{{ Str::ucfirst($request->type) }} </div>

            <label class="form-label" for="from">Punto de Partida</label>
            <div class="content-text">{{ $array_route->from }} </div>

            <label class="form-label" for="to">Destino</label>
            <div class="content-text">{{ $array_route->to }} </div>

            <label class="form-label" for="price">Precio</label>
            <div class="content-text">${{ number_format($price, 2) }} </div>

            <label class="form-label" for="duration">Tiempo Estimado</label>
            <div class="content-text">{{ $array_route->duration }} </div>

            <label class="form-label" for="distance">Distancia</label>
            <div class="content-text">{{ $array_route->distance }} Km. </div>

            <label class="form-label" for="comment">Observación</label>
            <div class="content-text">{{ $request->comment }} </div>

            <div class="buttons">
                <button id="confirm" type="submit" class="save-button">Confirmar</button>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        const form = document.getElementById('confirm_form');

        $('.save-button').click(function() {
            form.submit();
        });
    </script>
@endsection
