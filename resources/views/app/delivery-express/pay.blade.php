@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/delivery-express/style.css') }}">
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
        REGISTRAR PAGO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="delivery-express">
            <input type="hidden" id="rate" name="rate" value="{{$rate->rate}}">
            <form action="{{route('delivery.express.paid')}}" method="post">
                @csrf
                <input type="hidden" id="express_id" name="express_id" value="{{ $delivery->id }}">
                <label class="form-label" for="">Tipo de Servicio <span class="text-danger">*</span></label>
                <select class="form-select" id="service_id" name="service_id">
                    <option value="{{ $delivery->service_id }}">{{ $delivery->service->name }}</option>
                </select>
                <label class="form-label" for="currency_id">Moneda<span class="text-danger">*</span></label>
                <select class="form-control" id="currency_id" name="currency_id">
                    <option value="1">Dolares (USD)</option>
                    <option value="2" selected>Bolivares (VES)</option>
                </select>
                <label class="form-label" for="payment_option_id">Métodos de Pago<span class="text-danger">*</span></label>
                <select class="form-select" id="payment_option_id" name="payment_option_id">
                    @foreach ($payment_options as $option)
                        <option value="{{ $option->paymentMethod->id }}">{{ $option->paymentMethod->name }}</option>
                    @endforeach
                </select>
                <label class="form-label" for="amount">Monto<span class="text-danger">*</span></label>
                <input readonly class="form-control" type="number" id="amount" name="amount"
                    value="{{ number_format($amount, 2) }}">
                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label class="form-label" for="">Datos Bancarios:</label>
                <div>
                    @foreach ($DataBank as $Bank)
                        @foreach ($Bank as $data)
                            @if ($data->phone)
                                <div class="mobile_payment d-none">
                                    <div class="content-text">
                                        <span class="span-title">RIF:</span>
                                        {{ $data->document_type . '-' . $data->document }}
                                    </div>
                                    <div class="content-text">
                                        <span class="span-title">Banco:</span>
                                        {{ $data->bank->name }}
                                    </div>
                                    <div class="content-text">
                                        <span class="span-title">Teléfono:</span>
                                        {{ $data->phone }}
                                    </div>
                                </div>
                            @endif
                            @if ($data->account_number)
                                <div class="transfer_payment d-none">
                                    <div class="content-text">
                                        <span class="span-title">RIF:</span>
                                        {{ $data->document_type . '-' . $data->document }}
                                    </div>
                                    <div class="content-text">
                                        <span class="span-title">Banco:</span>
                                        {{ $data->bank->name }}
                                    </div>
                                    <div class="content-text">
                                        <span class="span-title">Cuenta:</span>
                                        {{ $data->account_number }}
                                    </div>
                                </div>
                            @endif
                            @if ($data->email)
                                <div class="zelle_payment d-none">
                                    <div class="content-text">
                                        <span class="span-title">Responsable:</span>
                                        {{ $data->owner_name }}
                                    </div>
                                    <div class="content-text">
                                        <span class="span-title">Correo Eléctronico:</span>
                                        {{ $data->email }}
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <label class="form-label" for="reference">Referencia<span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="reference" name="reference" placeholder="Últimos 6 digitos">
                @error('reference')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <button type="submit" class="save-button">Enviar</button>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
<script>

    $(document).ready(function(){
       $value =  $('#payment_option_id').val();
         showDataBank($value);
    });

   $('#payment_option_id').on('change', function(e)
   {
      $value = $(this).val();
        showDataBank($value);
   });

   $('#currency_id').on('change', function()
   {
      if($(this).val() == 1)
      {
         $rate = $('#rate').val();
         $amount = $('#amount').val();
         $total = $amount / $rate;
         $('#amount').val($total);
      }
      else
      {
         $rate = $('#rate').val();
         $amount = $('#amount').val();
         $total = $amount * $rate;
         $('#amount').val($total);
      }
   });

   function showDataBank($value)
   {
       if($value == 4)
       {
           $('.transfer_payment').removeClass('d-none');
           $('.mobile_payment').addClass('d-none');
           $('.zelle_payment').addClass('d-none');
       }
       else if($value == 5)
       {
           $('.zelle_payment').removeClass('d-none');
           $('.mobile_payment').addClass('d-none');
           $('.transfer_payment').addClass('d-none');
       }
       else
       {
           $('.mobile_payment').removeClass('d-none');
           $('.transfer_payment').addClass('d-none');
           $('.zelle_payment').addClass('d-none');
       }
   }
</script>
@endsection
