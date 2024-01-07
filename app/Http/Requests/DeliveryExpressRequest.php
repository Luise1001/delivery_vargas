<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Commerce;

class DeliveryExpressRequest extends FormRequest
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

        if ($this->type == 'personal') {
            $user = User::find(Auth::user()->id);

            if ($user->name && $user->last_name && $user->document && $user->phone && $user->gender) {
                $this->merge(['data' => true]);
            } else {
                $this->merge(['data' => false]);
            }
        } else if ($this->type == 'comercial') {
            $commerce = Commerce::where('user_id', Auth::user()->id)->first();
            if($commerce != null)
            {
                if ($commerce->name && $commerce->document && $commerce->phone) {
                    $this->merge(['data' => true]);
                } else {
                    $this->merge(['data' => false]);
                }
            }else{
                $this->merge(['data' => false]);
            }

        }

        return [
            'service_id' => 'required',
            'from' => 'required',
            'to' => 'required',
            'comment' => 'string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'El servicio es requerido',
            'from.required' => 'La dirección de origen es requerida',
            'to.required' => 'La dirección de destino es requerida',
        ];
    }
}
