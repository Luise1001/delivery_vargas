<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
                
             'latitude' => 'required|numeric',
             'longitude' => 'required|numeric',
             'address' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => 'Coordenada Requerida',
            'longitude.required' => 'Coordenada Requerida',
            'address.required' => 'El nombre de la dirección es requerido',
        ];
    }
}
