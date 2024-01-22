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
        DELIVERY EXPRESS
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="wrapper">
          @include('app.delivery-express.delivery-list.driver.orders.pending')
          @include('app.delivery-express.delivery-list.driver.orders.delivered')
          @include('app.delivery-express.delivery-list.driver.orders.cancelled')
        </div>
    </div>
@endsection

@section('javascripts')
@endsection
