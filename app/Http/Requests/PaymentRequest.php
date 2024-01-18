<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_option_id' => 'required',
            'amount' => 'required|numeric',
            'reference' => 'required|regex:/^[0-9]{6}$/',
        ];
    }

    public function messages()
    {
        return [
            'payment_option_id.required' => 'Debe seleccionar un método de pago',
            'amount.required' => 'Debe ingresar un monto',
            'amount.numeric' => 'El monto debe ser numerico',
            'reference.required' => 'Debe ingresar una referencia',
            'reference.numeric' => 'Debe ingresar una referencia',
            'reference.regex' => 'La referencia debe ser de 6 digitos',
        ];
    }
}
