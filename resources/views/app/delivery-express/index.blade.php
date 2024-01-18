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
        DELIVERY EXPRESS
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="delivery-express">
            <form action="{{ route('delivery.express.confirmation') }}" method="post">
                @csrf
                <label class="form-label" for="service_id">Tipo de Servicio</label>
                <div class="input-group">
                    <select class="form-select" id="service_id" name="service_id">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="type">Tipo de Solicitud</label>
                <div class="input-group">
                    <select class="form-select" id="type" name="type">
                        @if (auth()->user()->role_id == 5)
                            <option value="comercial">Comercial</option>
                        @else
                            <option value="personal">Personal</option>
                        @endif
                    </select>
                </div>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="from">Mis Direcciones<span class="text-danger">*</span></label>
                <select class="form-select" id="from" name="from">
                    @if ($location != null)
                        <option value="{{ $location->address }}">{{ $location->address }}</option>
                    @endif
                    @if ($locations->count() > 0)
                        @foreach ($locations as $location)
                            <option value="{{ $location->address }}">{{ $location->name }}</option>
                        @endforeach
                    @else
                        <option value="">No hay direcciones registradas</option>
                    @endif
                </select>
                @error('from')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label class="form-label" for="to">Destino<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="to" name="to" placeholder="Destino">
                @error('to')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="container-map">
                    <div id="googleMap" class="googleMap"></div>
                </div>
                <input type="hidden" id="route" name="route">
                <label class="form-label" for="comment">Observación <span class="optional">(opcional)</span></label>
                <textarea class="form-control" maxlength="150" id="comment" name="comment" cols="40" rows="3"
                    placeholder="Información adicional"></textarea>

                <div class="buttons">
                    <button id="enviar" type="submit" class="save-button">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('assets/js/delivery-express/maps/geocoding.js') }}"></script>
    <script src="{{ asset('assets/js/delivery-express/maps/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/delivery-express/maps/routes.js') }}"></script>
    <script src="{{ asset('assets/js/delivery-express/delivery_express.js') }}"></script>
@endsection
