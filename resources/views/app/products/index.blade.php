@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/products/style.css') }}">
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
     MIS PRODUCTOS
    <div><a href="{{route("commerce.product.create")}}" class="add-button"><i class="fa-solid fa-plus-circle"></i></a>
    </div>
</div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="wrapper">
             @include('app.products.components.available')
             @include('app.products.components.unavailable')
             @include('app.products.components.disabled')
        </div>
    </div>
@endsection

@section('javascripts')
 <script src="{{asset('assets/js/products/products.js')}}"></script>
@endsection
