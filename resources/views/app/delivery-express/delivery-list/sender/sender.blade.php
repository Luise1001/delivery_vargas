@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/delivery-express/delivery-list/style.css') }}">
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
        MIS DELIVERIES
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        @if ($role_level == 5)
            <div class="wrapper">
                @include('app.delivery-express.delivery-list.sender.comercial.pending')
                @include('app.delivery-express.delivery-list.sender.comercial.delivered')
                @include('app.delivery-express.delivery-list.sender.comercial.cancelled')
            </div>
        @else
            <div class="wrapper">
                @include('app.delivery-express.delivery-list.sender.personal.pending')
                @include('app.delivery-express.delivery-list.sender.personal.delivered')
                @include('app.delivery-express.delivery-list.sender.personal.cancelled')
            </div>
        @endif
    </div>
@endsection

@section('javascripts')
<script>
    $('.delete-delivery').on('click', function(e) {
    e.preventDefault();
    const form = $(this).closest('form');
    swal('Seguro que desea eliminar', '', 'warning', {
            buttons: {
                cancel: 'Cancelar',
                Confirmar: true,
            },
        })
        .then((value) => {
            switch (value) {

                case "Confirmar":
                    form.submit();
                    break;

                default:
                    false;
            }
        });
});
</script>
@endsection
