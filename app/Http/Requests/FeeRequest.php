<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'from' => 'required|numeric',
            'to' => 'required|numeric',
            'price' => 'required|numeric',
            'service_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'from.required' => 'El campo desde es requerido',
            'from.numeric' => 'El campo desde debe ser un número',
            'to.required' => 'El campo hasta es requerido',
            'to.numeric' => 'El campo hasta debe ser un número',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio debe ser un número',
            'service_id.required' => 'El campo servicio es requerido',
            'service_id.numeric' => 'El campo servicio debe ser un número',
        ];
    }
}
