<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('role_id', 4)->get();

        return view('app.drivers.index', compact('drivers'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('app.drivers.edit', compact('user'));
    }

    public function update(DriverRequest $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());

        return redirect()->route('driver.list.index');
    }
}
