@extends("app.layouts.index")

@section("meta")
    <meta name="theme-color" content="#fce944" />
@endsection

@section("styles")
    <link rel="stylesheet" href="{{ asset("assets/css/drivers/style.css") }}">
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
        CONDUCTORES
    </div>
@endsection

@section("content")
    <div class="principal-layout">
        @if ($drivers)
            @foreach ($drivers as $driver)
                <div class="card-list">
                    <div class="card-list-header">
                        <strong class="me-auto">{{$driver->created_at->format("d/m/y")}} </strong>
                        <small>{{$driver->updated_at->format("d/m/y H:i:s")}} </small>
                    </div>
                    <div class="card-list-body">
                        <div class="list-img">
                            @if ($driver->photo == true)
                            @php
                                $id = $driver->id;
                            @endphp
                            <img class="img-list"
                                src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                                alt="Foto de Perfil">
                        @else
                            @php
                                $letter = $driver->email[0];
                            @endphp
                            <img class="img-list"
                                src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                alt="Foto de Perfil">
                        @endif
                        </div>
                        <div class="list-data">
                            <div class="card-list-title">{{$driver->name.' '. $driver->last_name}}</div>
                            <div class="list-text">
                                <div> {{$driver->document_type.'-'.$driver->document}} </div>
                                <div>{{$driver->phone}} <a class="list-link" href="https://wa.me/{{$driver->phone}}" target="_blank"><i
                                            class="fa-brands fa-whatsapp"></i></a></div>
                                <div class="list-links">
                                    <a href="{{route('driver.list.edit', [$driver->id])}} "
                                        class="list-link">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection

@section("javascripts")
@endsection
