<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StaticLocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Static_location;

class StaticLocationController extends Controller
{

  public function index()
  {
    $user_id = Auth::user()->id;
    $static_locations = Static_location::where('user_id', $user_id)->get();

    return view('app.locations.index', compact('static_locations'));
  }

  public function store(StaticLocationRequest $request)
  {
    $user_id = Auth::user()->id;

    Static_location::create([
      'user_id' => $user_id,
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
      'name' => $request->name,
      'address' => $request->address,
    ]);

    return redirect()->route('static.location.index')->with('success', 'Ubicación guardada correctamente');
  }

  public function edit($id)
  {
    $static_location = Static_location::find($id);

    return view('app.locations.edit', compact('static_location'));
  }

  public function update(request $request)
  {
    $this->validate($request, [
      'name' => 'required'
    ],
  [
    'name.required' => 'El nombre es requerido'
  ]);

    $static_location = Static_location::find($request->id);

    $static_location->update($request->all());

    return redirect()->route('static.location.index')->with('success', 'Ubicación actualizada correctamente');
  }

  public function delete(request $request)
  {
    $static_location = Static_location::find($request->id);

    $static_location->delete();

    return redirect()->route('static.location.index')->with('success', 'Ubicación eliminada correctamente');
  }
}
