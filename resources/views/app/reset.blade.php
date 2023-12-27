@extends('app.layouts.logout')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('messagess')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">
        <button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>
        RESTAURAR CONTRASEÑA</div>
@endsection

@section('content')
    <div class="principal-layout">
            <form action="{{ route('reset.password.store') }}" method="post">
                @csrf
                <div class="p-2">
                    <label class='form-label' for='email'>Correo eléctronico<span class='text-danger'>*</span></label>
                    <input class='form-control' type='email' id='email' name='email' placeholder="Correo eléctronico">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class='buttons'>
                        <button type="submit" id='guardar' class='save-button'>Enviar</button>
                    </div>
                </div>
            </form>
    </div>
@endsection

@section('javascripts')
@endsection
