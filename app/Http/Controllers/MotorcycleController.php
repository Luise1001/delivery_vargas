<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Motorcycle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = Motorcycle::with('driver')->orderBy('updated_at', 'DESC')->get();

        return view('app.motorcycles.index', compact('motorcycles'));
    }

    public function create()
    {
        return view('app.motorcycles.create');
    }

    public function store(MotorcycleRequest $request)
    {
        $driver = User::where('document', $request->driver_id)->first();
        
        if (!$driver) {
            return redirect()->back()->with('error', 'El conductor no existe');
        }
        $driver_id = $driver->id;

        $request->merge(['driver_id' => $driver_id]);
        $this->validate(
            $request,
            [
                'driver_id' => ['required', Rule::unique('motorcycles', 'driver_id')]
            ],
            [
                'driver_id.unique' => 'El conductor ya tiene una moto registrada'
            ]
        );
        $user_id = Auth::user()->id;
        $request->merge(['created_by' => $user_id]);
        $motorcycle = Motorcycle::create($request->all());

        return redirect()->route('motorcycle.list.index');
    }

    public function edit($id)
    {
        $motorcycle = Motorcycle::with('driver')->find($id);

        return view('app.motorcycles.edit', compact('motorcycle'));
    }

    public function update(MotorcycleRequest $request)
    {
        $driver = User::where('document', $request->driver_id)->first();

        if (!$driver) {
            return redirect()->back()->with('error', 'El conductor no existe');
        }

        $driver_id = $driver->id;

        $request->merge(['driver_id' => $driver_id]);

        $this->validate(
            $request,
            [
                'driver_id' => ['required', Rule::unique('motorcycles', 'driver_id')->ignore($request->driver_id, 'driver_id')]
            ],
            [
                'driver_id.unique' => 'El conductor ya tiene una moto registrada'
            ]
        );

        $user_id = Auth::user()->id;
        $request->merge(['created_by' => $user_id]);
        $motorcycle = Motorcycle::find($request->id);
        $motorcycle->update($request->all());

        return redirect()->route('motorcycle.list.index');
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $motorcycle = Motorcycle::find($request->id);
        $motorcycle->delete();

        return redirect()->route('motorcycle.list.index');
    }
}
