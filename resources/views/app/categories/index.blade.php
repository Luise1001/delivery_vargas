@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories/style.css') }}">
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
        MIS CATEGORIAS
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="categories">
            <form id="category_form" action="{{ route('commerce.category.update') }}" method="post">
                @csrf
                @method('PUT')
                @if ($MyCategories)
                    @foreach ($MyCategories as $category)
                        <div class="form-check form-switch form-check-reverse switch-container">
                            <div class="text-switch">
                                {{ $category->category->name }}
                            </div>
                            <div class="input-switch">
                                <input class="form-check-input selector" checked type="checkbox" role="switch"
                                    value="{{ $category->category->id }}" name="category_id">
                                <label class="form-check-label" for="category_id"></label>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($categories as $category)
                            <div class="form-check form-switch form-check-reverse switch-container">
                                <div class="text-switch">
                                    {{ $category->name }}
                                </div>
                                <div class="input-switch">
                                    <input class="form-check-input selector" type="checkbox" role="switch"
                                        value="{{ $category->id }}" name="category_id">
                                    <label class="form-check-label" for="category_id"></label>
                                </div>
                            </div>
                    @endforeach
                @endif

                @error('categories')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="container">
                    <button class="save-button" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        const inputs = document.querySelectorAll('.selector');
        const form = document.getElementById('category_form');
        const array = [];

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            inputs.forEach(input => {

                if (input.checked) {
                    const categories = {
                        category_id: input.value
                    }

                    array.push(categories);
                }
            });
            let data = JSON.stringify(array);
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'categories');
            input.setAttribute('value', data);
            form.appendChild(input);
            form.submit();
        });
    </script>
@endsection
