@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/fees/style.css') }}">
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
        NUEVA TARIFA
    </div>
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="fees">
            <form action="{{ route('fee.store') }}" method="post">
                @csrf
                <div class="personal-data">
                    <label class="form-label" for="service_id">Servicio.<span class="text-danger">*</span></label>
                    <select class="form-select" id="service_id" name="service_id">
                        <option value="1">Delivery Vargas</option>
                    </select>
                    @error('service_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="marca">Desde Km.<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="from" name="from"
                        placeholder="Kilometraje Minimo">
                    @error('from')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="to">Hasta Km.<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="to" name="to"
                        placeholder="Kilometraje Maximo">
                    @error('to')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="price">Precio $<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="price" name="price"
                        placeholder="Precio en Dolares">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="checkbox" id="special" name="special" value="1">
                    <label class="form-label" for="special">Km. Adicional</label>
                    <div class="container">
                        <button id="guardar" class="save-button">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
@endsection
