@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/style.css') }}">
@endsection

@section('messagess')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">MI PERFIL</div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="p-2">
            <div class='header-profile'>
                @if ($user->photo == true)
                @php
                    $id = $user->id;
                @endphp
                <img class="foto_perfil" src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                    alt="Foto de Perfil">
            @else
                @php
                    $letter = $user->username[0];
                @endphp
                <img class="foto_perfil" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                    alt="Foto de Perfil">
            @endif
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type='file' accept='image/*' id='input_fp' name="input_fp" class='file-selector'>
                <label for='input_fp' class='file-selector-label'>
                    <span class='file-selector-span'><i class='fas fa-camera'></i></span>
                </label>

            </div>
                <label class="form-label" for="name">Nombres<span class="text-danger">*</span></label>
                <input class="form-control " type="text" id="name" name="name" value="{{ $user->name }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="form-label" for="last_name">Apellidos<span class="text-danger">*</span></label>
                <input class="form-control " type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
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
                        <option value="V">V</option>
                        <option value="E">E</option>
                        <option value="P">P</option>
                    </select>
                    <input class="form-control" type="number" id="document" name="document" value="{{ $user->document }}">
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
                <input class="form-control " type="number" id="phone" name="phone" value="{{ $user->phone }}">
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
<script src="{{asset('assets/js/profile/profile.js')}}"></script>
@endsection
