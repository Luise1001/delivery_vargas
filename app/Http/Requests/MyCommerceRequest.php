<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MyCommerceRequest extends FormRequest
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
        $user_id = Auth::user()->id;
        return [
            'document_type' => 'required',
            'document' => ['required', 'numeric', Rule::unique('commerces', 'document')->ignore($user_id, 'user_id')],
            'name' => 'required|string',	
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'document_type.required' => 'El tipo de documento es requerido',
            'document.required' => 'El documento es requerido',
            'document.numeric' => 'El documento debe ser numerico',
            'document.unique' => 'El documento ya existe',
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser numerico',
        ];
    }
}
