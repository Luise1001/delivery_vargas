@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/drivers/style.css') }}">
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
        EDITAR CONDUCTOR</div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="p-2">
            <form action="{{ route('driver.list.update') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id" value="{{$user->id}}">
                <label class="form-label" for="name">Nombres<span class="text-danger">*</span></label>
                <input class="form-control " type="text" id="name" name="name" placeholder="Nombres" value="{{ $user->name }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="last_name">Apellidos<span class="text-danger">*</span></label>
                <input class="form-control " type="text" id="last_name" name="last_name" placeholder="Apellidos" value="{{ $user->last_name }}">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="email">Correo Electrónico</label>
                <input readonly class="form-control " type="text" id="email" name="email"
                    value="{{ $user->email }}" disabled>
                <label class="form-label" for="document">Cédula de Identidad<span class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select perfil-select" id="document_type" name="document_type">
                        <option value="V" {{ $user->document_type == 'V' ? 'selected' : '' }}>V</option>
                        <option value="E" {{ $user->document_type == 'E' ? 'selected' : '' }}>E</option>
                        <option value="P" {{ $user->document_type == 'P' ? 'selected' : '' }}>P</option>
                    </select>
                    <input class="form-control" type="number" id="document" name="document" placeholder="Cédula" value="{{ $user->document }}">
                    @error('document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('document_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <label class="form-label" for="phone">Celular<span class="text-danger">*</span></label>
                <input class="form-control " type="number" id="phone" name="phone" placeholder="Teléfono" value="{{ $user->phone }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="gender">Genero<span class="text-danger">*</span></label>
                <input type="hidden" id="user_gender" value="{{ $user->gender }}">
                <div class="form-check">
                    <input class="form-check-input" value="F" type="radio" id="female" name="gender">
                    <label class="form-check-label" for="femenino">
                        Femenino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="M" type="radio" id="male" name="gender">
                    <label class="form-check-label" for="masculino">
                        Masculino
                    </label>
                </div>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="container">
                    <button type="submit" id="guardar_perfil" class="save-button">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
<script src="{{asset('assets/js/drivers/profile.js')}}"></script>
@endsection
