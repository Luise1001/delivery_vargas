@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/style.css') }}">
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
        <button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>
        CAMBIAR CONTRASEÑA
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <form action="{{ route('profile.password.store') }}" method="post">
            @csrf
            <div class="p-2">
                <label class='form-label' for='email'>Clave actual<span class='text-danger'>*</span></label>
                <input class='form-control' type='password' id='current_password' name='current_password'
                    placeholder="Clave actual">
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class='form-label' for='email'>Nueva clave<span class='text-danger'>*</span></label>
                <input class='form-control' type='password' id='new_password' name='new_password' placeholder="Nueva clave">
                @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class='form-label' for='email'>Confirmar clave<span class='text-danger'>*</span></label>
                <input class='form-control' type='password' id='confirm_password' name='confirm_password'
                    placeholder="Confirmar clave">
                @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class='buttons'>
                    <button type="submit" id='guardar' class='save-button'>Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
@endsection
