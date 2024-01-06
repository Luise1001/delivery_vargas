@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/payment-methods/style.css') }}">
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
        METODOS DE PAGO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="payment_methods">
            <form id="payment_form" action="{{ route('commerce.payment.method.update') }}" method="post">
                @csrf
                @method('PUT')
                @if ($myPaymentOptions)
                    @foreach ($myPaymentOptions as $option)
                        <div class="form-check form-switch form-check-reverse switch-container">
                            <div class="text-switch">
                                {{ $option->paymentMethod->name }}
                            </div>
                            <div class="input-switch">
                                <input class="form-check-input selector" type="checkbox" checked role="switch"
                                    value="{{ $option->payment_option_id }}" name="payment_option_id">
                                <label class="form-check-label" for="payment_option_id"></label>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($paymentOptions as $option)
                        <div class="form-check form-switch form-check-reverse switch-container">
                            <div class="text-switch">
                                {{ $option->name }}
                            </div>
                            <div class="input-switch">
                                <input class="form-check-input selector" type="checkbox" role="switch"
                                    value="{{ $option->id }}" name="payment_option_id">
                                <label class="form-check-label" for="payment_option_id"></label>
                            </div>
                        </div>
                    @endforeach
                @endif
                @error('payment_options')
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
        const form = document.getElementById('payment_form');
        const array = [];

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            inputs.forEach(input => {

                if (input.checked) {
                    const options = {
                        payment_option_id: input.value
                    }

                    array.push(options);
                }
            });
            let data = JSON.stringify(array);
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'payment_options');
            input.setAttribute('value', data);
            form.appendChild(input);
            form.submit();
        });
    </script>
@endsection
