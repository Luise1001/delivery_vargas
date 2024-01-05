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
        EDITAR PRODUCTO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <form action="{{ route('commerce.product.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="new-product">
                <div class="header">
                    @if ($product->photo)
                        @php
                            $commerce_id = $product->commerce_id;
                            $code = $product->code;
                        @endphp
                        <img id="img_producto" class="img-new-product"
                            src="{{ asset("assets/storage/products/commerces/$commerce_id/products/$code.jpg") }}"
                            alt="{{ $code }}">
                    @else
                        <img id="img_producto" class="img-new-product"
                            src="{{ asset('assets/storage/products/generico.png') }}" alt="codigo">
                    @endif
                    <input type="file" accept="image/*" id="image" name="image" class="file-selector">
                    <label for="image" class="file-selector-label">
                        <span class="file-selector-span"><i class="fas fa-camera"></i></span>
                    </label>
                </div>
                <div class="detail">
                    <input type="hidden" name="id" value={{$product->id}}>
                    <label class="form-label" for="code">Código<span class="text-danger">*</span></label>
                    <input readonly class="form-control " type="text" id="code" name="code"
                        placeholder="Identificación única" value="{{ $product->code }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="description">Descripción<span class="text-danger">*</span></label>
                    <input class="form-control " type="text" id="description" name="description"
                        placeholder="Describa el producto" value="{{ $product->description }}">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="full_price">Precio $<span class="text-danger">*</span></label>
                    <input class="form-control " type="number" id="full_price" name="full_price" placeholder="Precio neto"
                        value="{{ $product->full_price }}">
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
                            @php
                                if ($product->tax == 0) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                            @endphp
                            <input class="form-check-input selector" type="checkbox" name="tax" {{ $checked }}
                                role="switch" value="1">
                        </div>
                    </div>
                    <div class="middle-label">
                        <label class="form-label" for="weight">Peso Kg.<span class="text-danger">*</span></label>
                        <label class="form-label" for="quantity">Existencia<span class="text-danger">*</span></label>
                    </div>
                    <div class="input-group">
                        <input class="form-control m-1" type="text" id="weight" name="weight"
                            placeholder="Ej. 1 o 0,1" value="{{ $product->weight }}">
                        <input class="form-control m-1" type="number" id="quantity" name="quantity" placeholder="Ej. 1" value="{{$product->stock->quantity}}">
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
            let container = '.img-new-product';
            readImage(container, this);
        });
    </script>
@endsection
