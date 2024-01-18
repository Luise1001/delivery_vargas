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
        DETALLE
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="delivery-express">
            <label class="form-label" for="service_id">Tipo de Servicio</label>
            <div class="content-text">{{ $delivery->service->name }} </div>

            <label class="form-label" for="type">Tipo de Solicitud</label>
            <div class="content-text">{{ Str::ucfirst($delivery->type) }} </div>

            <label class="form-label" for="from">Punto de Partida</label>
            <div class="content-text"> {{ $delivery->route->from }} </div>

            <label class="form-label" for="to">Destino</label>
            <div class="content-text"> {{ $delivery->route->to }} </div>

            @if ($delivery->driver_id == true)
                <label class="form-label" for="driver">Conductor</label>
                <div class="content-text"> {{ $delivery->driver->name . ' ' . $delivery->driver->last_name }} </div>
            @endif

            <label class="form-label" for="price">Precio</label>
            <div class="content-text">${{ number_format($delivery->amount, 2) }} </div>

            <label class="form-label" for="paid">Estado del Pago</label>
            @if ($delivery->paid == true)
                <div class="content-text">Pagado</div>
                <div class="content-text">{{ $payment->reference }}</div>
            @else
                @if ($delivery->payment)
                    <div class="content-text">Por Verificar</div>
                @else
                <div class="content-text">Pendiente</div>
                @endif
            @endif

            <label class="form-label" for="duration">Tiempo Estimado</label>
            <div class="content-text">{{ $delivery->route->duration }} </div>

            <label class="form-label" for="distance">Distancia</label>
            <div class="content-text"> {{ $delivery->route->distance }} Km. </div>

            <label class="form-label" for="comment">Observación</label>
            <div class="content-text"> {{ $delivery->comment }} </div>

            <label class="form-label" for="status">Estado</label>
            <div class="content-text"> {{ $delivery->status }} </div>
        </div>
    </div>
@endsection

@section('javascripts')
@endsection
