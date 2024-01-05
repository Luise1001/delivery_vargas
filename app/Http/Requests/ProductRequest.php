<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required|min:3|max:10',
            'description' => 'required|string',
            'full_price' => 'required|numeric',
            'weight' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'El código es requerido',
            'code.min' => 'El código debe tener al menos 3 caracteres',
            'code.max' => 'El código debe tener máximo 10 caracteres',
            'description.required' => 'La descripción es requerida',
            'full_price.required' => 'El precio es requerido',
            'full_price.numeric' => 'El precio debe ser numérico',
            'weight.required' => 'El peso es requerido',
            'weight.numeric' => 'El peso debe ser numérico',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.numeric' => 'La cantidad debe ser numérica',

        ];
    }
}
