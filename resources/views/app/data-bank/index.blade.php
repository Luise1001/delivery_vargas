@extends("app.layouts.index")

@section("meta")
    <meta name="theme-color" content="#fce944" />
@endsection

@section("styles")
    <link rel="stylesheet" href="{{ asset("assets/css/data-bank/style.css") }}">
@endsection

@section("messages")
    @if (session()->has("success"))
        <div class="alert alert-success">
            {{ session()->get("success") }}
        </div>
    @endif
@endsection

@section("titulo-app")
    <div class="titulo-app">
        <button class="back-button" onclick=history.back()><i class="fa-solid fa-arrow-left"></i></button>
        DATOS BANCARIOS
        <div><a href="{{route("data.bank.create")}}" class="add-button"><i class="fa-solid fa-plus-circle"></i></a>
        </div>
    </div>
@endsection

@section("content")
<div class="principal-layout">
    <div class="wrapper">
        @include("app.data-bank.components.mobile")
        @include("app.data-bank.components.transfer")
        @include("app.data-bank.components.zelle")

    </div>
</div>
@endsection

@section("javascripts")

<script>
    $('.delete-bank').on('click', function(e) {
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
