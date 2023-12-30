@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/buy/style.css') }}">
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
        {{ Str::upper($category) }}</div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="comercios">
            @if ($commerce_list)
            @foreach ($commerce_list as $commerce)
                <a href="{{route('buy.products.list', ['comercio' => $commerce->commerce->name, 'id'=> $commerce->commerce->id])}}" class="item-grid">
                    <div>
                        @if ($commerce->commerce->user->photo == true)
                            @php
                                $id = $commerce->commerce->user->id;
                            @endphp
                            <img class="img-commerce" src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                                alt="Comercio Afiliado">
                        @else
                            @php
                                $letter = $commerce->commerce->user->username[0];
                            @endphp
                            <img class="img-commerce" src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                alt="Comercio Afiliado">
                        @endif
                        <div class="item-grid-body">
                            <h5 class="item-grid-title">{{$commerce->commerce->name}} </h5>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
        </div>
    </div>
@endsection

@section('javascripts')
@endsection
