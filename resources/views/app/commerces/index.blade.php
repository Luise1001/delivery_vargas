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
        COMERCIOS AFILIADOS
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="commerces">
            @if ($commerces)
                @foreach ($commerces as $commerce)
                    <div class='card-list'>
                        <div class='card-list-header'>
                            <strong class='me-auto'>{{ $commerce->created_at->format('d/m/y') }} </strong>
                            <small> {{ $commerce->updated_at->format('d/m/y H:i:s') }} </small>
                        </div>
                        <div class='card-list-body'>
                            <div class='list-img'>
                                @if ($commerce->photo == true)
                                    @php
                                        $id = $commerce->id;
                                    @endphp
                                    <img class="img-list"
                                        src="{{ asset("assets/storage/profile/commerces/$id/photo/perfil.jpg") }}"
                                        alt="Foto de Perfil">
                                @else
                                    @php
                                        $letter = $commerce->name[0];
                                    @endphp
                                    <img class="img-list" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                        alt="Foto de Perfil">
                                @endif
                            </div>
                            <div class='list-data'>
                                <div class='card-list-title'> {{ $commerce->name }} </div>
                                <div class='list-text'>
                                    <div>{{ $commerce->phone }} <a href="https://wa.me/{{ $commerce->phone }}"
                                            target='_blank'>
                                            <i class='fa-brands fa-whatsapp'></i></a></div>
                                    <div>
                                        @if ($commerce->static_location == true)
                                            @foreach ($commerce->static_location as $location)
                                                @if ($location->type == 'commerce')
                                                @php
                                                $address = str_replace(' ', '+', $location->address);
                                                @endphp
                                                    <div><a class='list-link'
                                                            href="https://www.google.com/maps/place/{{ $address }}"
                                                            target='_blank'>{{ $location->name }} <i
                                                                class='fa-solid fa-location-dot'></i></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
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
@endsection
