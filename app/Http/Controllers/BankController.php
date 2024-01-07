<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;
use App\Models\Mobile_payment;
use App\Models\Transfer_payment;
use App\Models\Zelle_payment;
use App\Models\Commerce;

class BankController extends Controller
{
    public function index()
    {
        $commerce = Commerce::where('user_id', Auth::user()->id)->first();
        if(!$commerce)
        {
          return redirect()->route('commerce.myCommerce');
        }

        $mobile_payments = Mobile_payment::where('commerce_id', $commerce->id)->with('bank')->get();
        $transfer_payments = Transfer_payment::where('commerce_id', $commerce->id)->with('bank')->get();
        $zelle_payments = Zelle_payment::where('commerce_id', $commerce->id)->get();

        return view('app.data-bank.index', compact('mobile_payments', 'transfer_payments', 'zelle_payments'));
    }

    public function create()
    {
        $banks = Bank::all();

        return view('app.data-bank.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $type = $request->type;
        $insert = $this->$type($request, 'create');


        return redirect()->route('data.bank.index');
    }

    public function edit($type, $id)
    { 
        $banks = Bank::all();
        $data = '';

        if($type == 'mobile')
        {
            $data = Mobile_payment::where('id', $id)->first();
        }
        else if($type == 'transfer')
        {
            $data = Transfer_payment::where('id', $id)->first();
        }
        else if($type == 'zelle')
        {
            $data = Zelle_payment::where('id', $id)->first();
        }

        return view('app.data-bank.edit', compact('banks', 'type', 'data'));
    }

    public function update(Request $request)
    {
        $type = $request->type;
        $update= $this->$type($request, 'update');


        return redirect()->route('data.bank.index');
    }

    public function delete(Request $request)
    {
        $type = $request->type;

        if($type == 'mobile')
        {
            Mobile_payment::where('id', $request->id)->delete();
        }
        else if($type == 'transfer')
        {
            Transfer_payment::where('id', $request->id)->delete();
        }
        else if($type == 'zelle')
        {
            Zelle_payment::where('id', $request->id)->delete();
        }

        return redirect()->route('data.bank.index');
    }

    private function mobile(Request $request, $type)
    {
        $user_id = Auth::user()->id;
        $request->merge(['user_id' => $user_id]);

        $this->validate(
            $request,
            [
                'type' => 'required',
                'bank_id' => 'required',
                'document_type' => 'required',
                'document' => 'required',
                'phone' => 'required|min:11|max:11',
                'user_id' => 'exists:commerces,user_id',
            ],
            [
                'type.required' => 'El tipo de cuenta es requerido',
                'bank_id.required' => 'El banco es requerido',
                'document_type.required' => 'El tipo de documento es requerido',
                'document.required' => 'El número de documento es requerido',
                'phone.required' => 'El teléfono es requerido',
                'phone.min' => 'El teléfono debe tener 11 dígitos',
                'phone.max' => 'El teléfono debe tener 11 dígitos',
                'user_id.exists' => 'El usuario no tiene un comercio asociado',
            ]
        );

        $commerce_id = Commerce::where('user_id', $request->user_id)->first()->id;
        $request->merge(['commerce_id' => $commerce_id]);

        if($type === 'create')
        {
            Mobile_payment::create([
                'bank_id' => $request->bank_id,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'phone' => $request->phone,
                'commerce_id' => $request->commerce_id,
            ]);
        }
        else if($type == 'update'){
            Mobile_payment::where('id', $request->id)->update([
                'bank_id' => $request->bank_id,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'phone' => $request->phone,
            ]);
        }

        return true;
    }

    private function transfer(Request $request, $type)
    {
        $user_id = Auth::user()->id;
        $request->merge(['user_id' => $user_id]);

        $this->validate(
            $request,
            [
                'type' => 'required',
                'bank_id' => 'required',
                'document_type' => 'required',
                'document' => 'required',
                'account_number' => 'required|min:20|max:20',
                'user_id' => 'exists:commerces,user_id',
            ],
            [
                'type.required' => 'El tipo de cuenta es requerido',
                'bank_id.required' => 'El banco es requerido',
                'document_type.required' => 'El tipo de documento es requerido',
                'document.required' => 'El número de documento es requerido',
                'account_number.required' => 'El número de cuenta es requerido',
                'account_number.min' => 'El número de cuenta debe tener 20 dígitos',
                'account_number.max' => 'El número de cuenta debe tener 20 dígitos',
                'user_id.exists' => 'El usuario no tiene un comercio asociado',
            ]
        );

        $commerce_id = Commerce::where('user_id', $request->user_id)->first()->id;
        $request->merge(['commerce_id' => $commerce_id]);

        if($type === 'create')
        {
            Transfer_payment::create([
                'bank_id' => $request->bank_id,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'account_number' => $request->account_number,
                'commerce_id' => $request->commerce_id,
            ]);
        }
        else if($type == 'update') {
            Transfer_payment::where('id', $request->id)->update([
                'bank_id' => $request->bank_id,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'account_number' => $request->account_number,
            ]);
        }

        return true;
    }

    private function zelle(Request $request, $type)
    {
        $user_id = Auth::user()->id;
        $request->merge(['user_id' => $user_id]);

        $this->validate(
            $request,
            [
                'type' => 'required',
                'owner_name' => 'required|string',
                'email' => 'required|email',
                'user_id' => 'exists:commerces,user_id',
            ],
            [
                'type.required' => 'El tipo de cuenta es requerido',
                'owner_name.required' => 'El nombre del propietario es requerido',
                'owner_name.string' => 'El nombre del propietario debe ser una cadena de texto',
                'email.required' => 'El correo electrónico es requerido',
                'email.email' => 'El correo electrónico debe ser válido',
                'user_id.exists' => 'El usuario no tiene un comercio asociado',
            ]
        );

        $commerce_id = Commerce::where('user_id', $request->user_id)->first()->id;
        $request->merge(['commerce_id' => $commerce_id]);
        
        if($type === 'create')
        {
            Zelle_payment::create([
                'owner_name' => $request->owner_name,
                'email' => $request->email,
                'commerce_id' => $request->commerce_id
            ]);
        }
        else if($type == 'update'){
            Zelle_payment::where('id', $request->id)->update([
                'owner_name' => $request->owner_name,
                'email' => $request->email
            ]);
        }


        return true;
    }
}
