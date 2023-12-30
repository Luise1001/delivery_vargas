@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/fees/style.css') }}">
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
        TARIFAS
        <div><a href="{{route('fee.create')}}" class="add-button"><i class="fa-solid fa-plus-circle"></i></a>
        </div>
    </div>
@endsection

@section('content')
<div class="principal-layout">
    <div class="wrapper">
        @include('app.fees.components.normal')
        @include('app.fees.components.special')
    </div>
</div>
@endsection

@section('javascripts')
<script src="{{asset('assets/js/fees/fees.js')}}"></script>
@endsection
