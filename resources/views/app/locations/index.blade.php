@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/locations/style.css') }}">
@endsection

@section('messagess')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">MIS DIRECCIONES</div>
@endsection

@section('content')
    <div class="principal-layout">
        @if ($static_locations)
            @foreach ($static_locations as $location)
                <div class="card-direction">
                    <div class="card-direction-header">
                        <div class="card-direction-title">
                            <i class="fa-solid fa-map-marker-alt"></i>
                            <input hidden name="id" type="text" value="{{ $location->id }}">
                            <input class="input-direccion" readonly id="name_{{ $location->id }}" name="name"
                                type="text" value=" {{ $location->name }} " />
                        </div>
                        <div class="card-time"> {{ $location->updated_at->format('d/m/y') }} </div>
                    </div>
                    <div class="card-direction-body">
                        {{ $location->address }}
                    </div>
                    <div class="card-direction-links">
                        <a href=" {{ route('static.location.edit', $location->id) }} "
                            class="card-direction-link">Editar</a>
                        <form action="{{ route('static.location.delete') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="id" name="id" value="{{ $location->id }}">
                            <button type="submit" class="card-direction-link delete-direction">Eliminar</button>
                        </form>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('javascripts')
    <script>
        $('.delete-direction').on('click', function(e) {
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
