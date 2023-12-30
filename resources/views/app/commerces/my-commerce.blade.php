@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/commerces/style.css') }}">
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
        MI COMERCIO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="p-2">
            <div class='header-profile'>
                @if ($myCommerce->photo == true)
                    @php
                        $id = $myCommerce->id;
                    @endphp
                    <img class="foto_perfil" src="{{ asset("assets/storage/profile/commerces/$id/photo/perfil.jpg") }}"
                        alt="Foto de Perfil">
                @else
                    @php
                        $letter = Auth::user()->email[0];
                    @endphp
                    <img class="foto_perfil" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                        alt="Foto de Perfil">
                @endif
                <form action="{{ route('commerce.myCommerce.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type='file' accept='image/*' id='input_fp' name="input_fp" class='file-selector'>
                    <label for='input_fp' class='file-selector-label'>
                        <span class='file-selector-span'><i class='fas fa-camera'></i></span>
                    </label>

            </div>
            <label class="form-label" for="name">Razón Social<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name" placeholder="Razón Social" value="{{ $myCommerce->name }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label class="form-label" for="document">Rif<span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select perfil-select" id="document_type" name="document_type">
                    <option value="J" {{ $myCommerce->document_type == 'J' ? 'selected' : '' }}>J</option>
                    <option value="G" {{ $myCommerce->document_type == 'G' ? 'selected' : '' }}>G</option>
                    <option value="V" {{ $myCommerce->document_type == 'V' ? 'selected' : '' }}>V</option>
                    <option value="E" {{ $myCommerce->document_type == 'E' ? 'selected' : '' }}>E</option>
                    <option value="P" {{ $myCommerce->document_type == 'P' ? 'selected' : '' }}>P</option>
                </select>
                <input class="form-control" type="number" id="document" name="document" placeholder="Rif" value="{{ $myCommerce->document }}">
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
            <label class="form-label" for="phone">Teléfono de Contacto<span class="text-danger">*</span></label>
            <input class="form-control " type="number" id="phone" name="phone" placeholder="Teléfono" value="{{ $myCommerce->phone }}">
            @error('phone')
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
    <script>
        $(document).on('change', '#input_fp', function() {
            let container = '.foto_perfil';
            readImage(container, this);
        });
    </script>
@endsection
