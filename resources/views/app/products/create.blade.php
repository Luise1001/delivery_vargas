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
        NUEVO PRODUCTO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <form action="{{ route('commerce.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="new-product">
                <div class="header">
                    <img id="img_producto" class="img-product" src="{{ asset('assets/storage/products/generico.png') }}"
                        alt="codigo">
                    <input type="file" accept="image/*" id="image" name="image" class="file-selector">
                    <label for="image" class="file-selector-label">
                        <span class="file-selector-span"><i class="fas fa-camera"></i></span>
                    </label>
                </div>
                <div class="detail">
                    <label class="form-label" for="code">Código<span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="code" name="code"
                        placeholder="Identificación única">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="description">Descripción<span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="description" name="description"
                        placeholder="Describa el producto">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="full_price">Precio $<span class="text-danger">*</span></label>
                    <input class="form-control " type="number" id="full_price" name="full_price" placeholder="Precio neto">
                    @error('full_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-check form-switch form-check-reverse switch-container pt-2">
                        <div class="text-switch">
                            Exento
                        </div>
                        <div class="input-switch">
                            <input class="form-check-input selector" type="checkbox" name="tax" role="switch"
                                value="1">
                        </div>
                    </div>
                    <div class="middle-label">
                        <label class="form-label" for="weight">Peso Kg.<span class="text-danger">*</span></label>
                        <label class="form-label" for="quantity">Existencia<span class="text-danger">*</span></label>
                    </div>
                    <div class="input-group">
                        <input class="form-control m-1" type="text" id="weight" name="weight"
                            placeholder="Ej. 1 o 0,1">
                        <input class="form-control m-1" type="number" id="quantity" name="quantity" placeholder="Ej. 1">
                    </div>
                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="container">
                        <button class="save-button">Guardar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('javascripts')
    <script>
        $(document).on('change', '#image', function() {
            let container = '.img-product';
            readImage(container, this);
        });
    </script>
@endsection
