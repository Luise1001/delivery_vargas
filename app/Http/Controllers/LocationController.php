<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;

class LocationController extends Controller
{
    public function store(LocationRequest $request)
    {
        $user_id = Auth::user()->id;
        if (Location::where('user_id', $user_id)->exists()) {
            $location = Location::where('user_id', $user_id)->first();

            $location->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address' => $request->address
            ]);
        } else {
            Location::create([
                'user_id' => $user_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address' => $request->address
            ]);
        }

        
    }
}
