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
        MOTOS
        <div><a href="{{ route('motorcycle.list.create') }}" class="add-button"><i class="fa-solid fa-plus-circle"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="motorcycles">
            @if ($motorcycles)
                @foreach ($motorcycles as $motorcycle)
                    <div class="card-list">
                        <div class="card-list-header">
                            <strong class="me-auto">{{ $motorcycle->created_at->format('d/m/y') }} </strong>
                            <small>{{ $motorcycle->updated_at->format('d/m/y H:i:s') }} </small>
                        </div>
                        <div class="card-list-body">
                            <div class="list-img">
                                @if ($motorcycle->driver->photo == true)
                                    @php
                                        $id = $motorcycle->driver->id;
                                    @endphp
                                    <img class="img-list"
                                        src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                                        alt="Foto de Perfil">
                                @else
                                    @php
                                        $letter = $motorcycle->driver->email[0];
                                    @endphp
                                    <img class="img-list" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                        alt="Foto de Perfil">
                                @endif
                            </div>
                            <div class="list-data">
                                <div class="card-list-title">
                                    {{ $motorcycle->driver->name . ' ' . $motorcycle->driver->last_name }}</div>
                                <div class="list-text">
                                    <div>{{ $motorcycle->brand . ' ' . $motorcycle->model }} </div>
                                    <div>{{ Str::upper($motorcycle->plate) }} </div>
                                    <div>{{ $motorcycle->year_model }} </div>
                                    <div class="list-links">
                                        <a href="{{ route('motorcycle.list.edit', $motorcycle->id) }}"
                                            class="list-link">Editar</a>
                                        <form action="{{ route('motorcycle.list.delete', $motorcycle->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$motorcycle->id}}">
                                            <button class="list-link delete-moto">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('javascripts')
<script src="{{asset('assets/js/motorcycles/motorcycles.js')}}"></script>
@endsection
