@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/locations/style.css') }}">
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
        EDITAR DIRECCIÓN</div>
@endsection

@section('content')
    <div class="principal-layout">
        @if ($static_location)
            <form action="{{ route('static.location.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="edit-direction">
                    <label class='form-label' for='name'>Nombre<span class='text-danger'>*</span></label>
                    <input hidden type="hidden" id="id" name="id" value="{{$static_location->id}} ">
                    <input class='form-control' type='text' id='name' name='name'
                        value="{{ $static_location->name }}" placeholder="Nombre">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 1)
                    <label class='form-label' for='type'>Tipo<span class='text-danger'>*</span></label>
                    <select class="form-select" id="type" name="type">
                        <option value="personal" {{ $static_location->type == 'personal' ? 'selected' : '' }}>Personal</option>
                        <option value="commerce" {{ $static_location->type == 'commerce' ? 'selected' : '' }}>Comercial</option>
                    </select>
                    @endif

                    <div class='buttons'>
                        <button type="submit" id='guardar' class='save-button'>Guardar</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection

@section('javascripts')
@endsection
