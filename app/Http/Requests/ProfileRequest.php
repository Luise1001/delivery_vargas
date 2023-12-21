<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' =>'required|string',
            'last_name' =>'required|string',
            'phone' =>'required|numeric',
            'document_type' => 'required|string|min:1|max:1',
            'document' => 'required|numeric',
            'gender' => 'required|min:1|max:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'last_name.required' => 'El apellido es requerido',
            'last_name.string' => 'El apellido debe ser una cadena de texto',
            'phone.required' => 'El teléfono es requerido',
            'phone.numeric' => 'El teléfono debe ser un numero',
            'document_type.required' => 'El tipo de documento es requerido',
            'document_type.string' => 'El tipo de documento debe ser una cadena de texto',
            'document_type.min' => 'El tipo de documento debe tener mínimo 1 carácter',
            'document_type.max' => 'El tipo de documento debe tener máximo 1 carácter',
            'document.required' => 'El número de documento es requerido',
            'document.numeric' => 'El documento debe ser numérico',
            'gender.required' => 'El genero es requerido'
        ];
    }
}
