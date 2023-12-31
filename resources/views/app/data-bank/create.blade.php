@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/data-bank/style.css') }}">
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
        NUEVOS DATOS BANCARIOS
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="data-bank">
                <label class="form-label" for="type">Tipo<span class="text-danger">*</span></label>
                <select class="form-select" id="type" name="type">
                    <option value="mobile">Pago Móvil</option>
                    <option value="transfer">Transferencia</option>
                    <option value="zelle">Zelle</option>
                </select>
                @include('app.data-bank.partials.create.mobile')
                @include('app.data-bank.partials.create.transfer')
                @include('app.data-bank.partials.create.zelle')
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('assets/js/data-bank/data-bank.js') }}"></script>
@endsection
