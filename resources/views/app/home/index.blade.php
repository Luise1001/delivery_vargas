@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
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
<div class="titulo-app">DELIVERY VARGAS</div>
@endsection

@section('content')
    <div class="container-map">
        <div class="index-map">
            <div class="container-fluid">
                <form id="my-location" action=" {{route('location.store')}} " method="post" class="form-mi-ubicacion">
                    @csrf
                    <div class="form-group col-md-12 text-center">
                        <label id="label-my-location" for="from" class="form-label"> Mi Ubicación: </label>
                        <div>
                            <i class="fas fa-map-marker-alt marker-my-location"></i>
                            <input class='input-from' id="address" name="address" type="text" placeholder="Mi Ubicación ">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                            @enderror
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <br>
                        </div>

                        <div id="direction_name" class="d-none">
                            <i class="fas fa-map-marker-alt marker-my-location"></i>
                            <input class="input-from" id="name" name="name" type="text" placeholder="Ej. Casa">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                            @enderror

                        </div>

                        <div class="form-group col-md-12 text-center m-2">
                            <button id="confirm_location" class="confirmar-location">
                                <i class="fas fa-directions"></i> Confirmar
                            </button>
                        </div>

                        <input class='form-check-input' type='checkbox' value='' id='save_location' name='save_location'>
                        <label id="save_location_label" class='form-label' for='save_location'>
                            Guardar Dirección
                        </label>

                        <div class="form-group col-md-12 text-center m-2">
                            <button id="save" class="confirmar-location d-none">
                                <i class="fas fa-directions"></i> Guardar
                            </button>
                        </div>
                    </div>
            </div>
            </form>

            <form hidden id="form-static-location" method="post" action=" {{ route('static.location.store') }} ">
                @csrf

            </form>
            <div class="container-map">
                <div id="googleMap">

                </div>
                <div hidden id="output">

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('javascripts')
 <script src=" {{asset('assets/js/home/maps/geocoding.js') }} "></script>
 <script src=" {{asset('assets/js/home/maps/autocomplete.js') }} "></script>
 <script src=" {{asset('assets/js/home/maps/routes.js') }} "></script>
 <script src=" {{asset('assets/js/home/maps/home.js') }} "></script>
@endsection
