<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MotorcycleRequest extends FormRequest
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
            'brand' => 'required',
            'plate' => ['required', Rule::unique('motorcycles', 'plate')->ignore($this->plate, 'plate')],
            'model' => 'required',
            'year_model' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => 'La marca es requerida',
            'plate.required' => 'La placa es requerida',
            'plate.unique' => 'La placa ya existe',
            'model.required' => 'El modelo es requerido',
            'year_model.required' => 'El año es requerido',
        ];
    }
}
