<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaticLocationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string'
        ];
    }

    public function messages()
    {
       return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'latitude.required' => 'La latitud es requerida',
            'latitude.numeric' => 'La latitud debe ser un número',
            'longitude.required' => 'La longitud es requerida',
            'longitude.numeric' => 'La longitud debe ser un número',
            'address.required' => 'La dirección es requerida',
            'address.string' => 'La dirección debe ser una cadena de texto'
        ];
    }
}
