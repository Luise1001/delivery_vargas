@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/motorcycles/style.css') }}">
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
        EDITAR MOTO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="p-2">
            <form action="{{ route('motorcycle.list.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="personal-data">
                    <input type="hidden" name="id" value="{{$motorcycle->id}}">
                    <label class="form-label" for="marca">Marca<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="brand" name="brand" value="{{$motorcycle->brand}}" placeholder="Marca">
                    @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="modelo">Modelo<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="model" name="model" value="{{$motorcycle->model}}" placeholder="Modelo">
                    @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="placa">Placa<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="plate" name="plate" value="{{$motorcycle->plate}}" placeholder="Placa">
                    @error('plate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="year">Año<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="year_model" name="year_model" value="{{$motorcycle->year_model}}" placeholder="Año">
                    @error('year_model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="cedula">Cédula Del Conductor<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="driver_id" name="driver_id" value="{{$motorcycle->driver->document}}"
                        placeholder="Cédula del conductor">
                    @error('driver_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="container">
                        <button id="guardar_moto" class="save-button">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')

@endsection
