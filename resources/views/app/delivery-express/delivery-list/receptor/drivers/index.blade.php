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
        ASIGNAR CONDUCTOR
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="delivery-express">
            <form action="{{ route('delivery.express.assign') }}" method="post">
                @csrf
                @method('PUT')
                <label for="driver_id" class="form-label">Conductores <span class="text-danger">*</span> </label>
                <input type="hidden" id="id" name="id" value="{{ $deliveryExpress->id }}">
                <input id="order_location" type="hidden" value="{{ $deliveryExpress->route->from }}">
                <select id="driver_id" name="driver_id" class="form-select">

                    @if ($drivers->count() > 0)
                        @foreach ($drivers as $driver)
                            @if ($driver->location != null)
                                <option value="{{ $driver->id }}" location="{{ $driver->location->address }}">
                                    {{ $driver->name . ' ' . $driver->last_name }}
                                </option>
                            @endif
                        @endforeach
                    @endif

                </select>

                <button class="save-button" type="submit">Enviar</button>
            </form>

            <div class="map" id="map">
                <div id="googleMap"></div>
            </div>
            <div hidden id="output"></div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script src=" {{ asset('assets/js/home/maps/geocoding.js') }} "></script>
    <script src=" {{ asset('assets/js/home/maps/autocomplete.js') }} "></script>
    <script src=" {{ asset('assets/js/home/maps/routes.js') }} "></script>
    <script src=" {{ asset('assets/js/drivers/locations.js') }} "></script>
@endsection
