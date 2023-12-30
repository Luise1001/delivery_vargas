@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/users/style.css') }}">
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
        EDITAR USUARIO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <form action="{{ route('user.list.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="p-2">
                <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                <label class='form-label' for='email'>Correo Electrónico<span class='text-danger'></span></label>
                <input class='form-control' type='text' readonly id='email' name='email' placeholder="Email"
                    value="{{ $user->email }}">
                <label class="form-label" for="role">Tipo de Usuario<span class="text-danger">*</span></label>
                <select class="form-select" id="role" name="role">
                    @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
                        <option value="2" {{ $user->role_id == '2' ? 'selected' : '' }}>Administrador</option>
                    @endif
                    <option value="3" {{ $user->role_id == '3' ? 'selected' : '' }}>Supervisor</option>
                    <option value="4" {{ $user->role_id == '4' ? 'selected' : '' }}>Conductor</option>
                    <option value="5" {{ $user->role_id == '5' ? 'selected' : '' }}>Comercio Afiliado</option>
                    <option value="6" {{ $user->role_id == '6' ? 'selected' : '' }}>Usuario General</option>
                </select>
                <div class='buttons'>
                    <button type="submit" id='guardar' class='save-button'>Enviar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
@endsection
