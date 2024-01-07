<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DeliveryExpressRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Location;
use App\Models\Static_location;
use App\Models\Route;
use App\Models\DeliveryExpress;
use App\Models\Fee;

class DeliveryExpressController extends Controller
{
    public function index()
    {
        $role_level = Auth::user()->role->level;
        $services = Service::all();

        if ($role_level <= 3) {

            return view('app.delivery-express.delivery-list.receptor.receptor');

        } else if ($role_level == 4) {

            return view('app.delivery-express.delivery-list.driver.driver');

        } else if ($role_level > 4) {

            $location = Location::where('user_id', Auth::user()->id)->first();
            $locations = Static_location::where('user_id', Auth::user()->id)->get();
    
            return view('app.delivery-express.index', compact('services', 'location', 'locations'));
        }


    }

    public function confirm(DeliveryExpressRequest $request)
    {
        if ($request->data == false && $request->type == 'personal') {

            return redirect()->route('profile.index');
        } else if ($request->data == false && $request->type == 'comercial') {

            return redirect()->route('commerce.myCommerce');
        }

        $array_route = json_decode($request->route);
        $price = $this->fee($array_route->distance, $request->service_id);
        $service = Service::find($request->service_id);

        return view('app.delivery-express.confirmation', compact('array_route', 'service', 'request', 'price'));
    }

    public function store(Request $request)
    {
        $array_route = json_decode($request->route);

        if ($request->type == 'personal') {
            $column = 'user_id';
            $user = Auth::user()->id;
        } else {
            $column = 'commerce_id';
            $user = Auth::user()->commerce->id;
        }

        $route = Route::create([
            'service_id' => $request->service_id,
            'from' => $array_route->from,
            'to' => $array_route->to,
            'distance' => $array_route->distance,
            'duration' => $array_route->duration,
            'url_map' => $array_route->url_map,
            $column => $user,
        ]);

        $delivery = DeliveryExpress::create([
            'service_id' => $request->service_id,
            'route_id' => $route->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'confirmed' => 1
        ]);

        return redirect()->route('delivery.express.myDeliveries');

    }


    public function myDeliveries()
    {
        $user_id = Auth::user()->id;
        $my_deliveries = DeliveryExpress::where(['user_id' => $user_id])->get();

        return view('app.delivery-express.delivery-list.sender.sender', compact('my_deliveries'));
    }

    public function fee($distance, $service)
    {

        $fees = Fee::where(['service_id' => $service, 'special' => false])->get();

        foreach ($fees as $fee) {
            if ($distance >= $fee->from && $distance <= $fee->to) {
                $price = $fee->price;

                return $price;
            }
        }

        $fee = Fee::where(['service_id' => $service, 'special' => false])->orderBy('id', 'desc')->first();
        $special = Fee::where(['service_id' => $service, 'special' => true])->first();
        $price = $fee->price + (($distance - $fee->to) * $special->price);

        return $price;
    }
}
