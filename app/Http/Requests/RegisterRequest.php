<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
             'email' => 'required|email|unique:users,email',
             'password' => 'required',
             'repeat_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
          'email.required' => 'El email es requerido',
          'email.email' => 'Debe ser un email válido',
          'email.unique' => 'El email ya existe en la base de datos',
          'password.required' => 'La contraseña es requerida',
          'repeat_password.required' => 'La confirmación de la contraseña es requerida',
          'repeat_password.same' => 'Las contraseñas no coinciden'
        ];
    }
}
