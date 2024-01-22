<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\DeliveryExpressRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Commerce;
use App\Models\User;
use App\Models\Service;
use App\Models\Location;
use App\Models\Static_location;
use App\Models\Route;
use App\Models\DeliveryExpress;
use App\Models\Fee;
use App\Models\Rate;
use App\Models\History_payment;
use App\Models\Commerce_payment_method;
use App\Models\Mobile_payment;
use App\Models\Transfer_payment;
use App\Models\Zelle_payment;

class DeliveryExpressController extends Controller
{
    protected $DataBank = [];

    public function index()
    {
        $role_level = Auth::user()->role->level;
        $services = Service::all();

        if ($role_level == 2 || $role_level == 3) {

            $deliveryExpress = DeliveryExpress::with('service', 'route', 'driver', 'user', 'commerce', 'payment')->get();

            return view('app.delivery-express.delivery-list.receptor.receptor', compact('deliveryExpress'));
        } else if ($role_level == 4) {
            $driver_id = Auth::user()->id;

            $deliveryExpress = DeliveryExpress::with('service', 'route', 'driver', 'user', 'commerce', 'payment')
                ->where('driver_id', $driver_id)->get();

            return view('app.delivery-express.delivery-list.driver.driver', compact('deliveryExpress'));
        } else if ($role_level > 4 || $role_level == 1) {

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
            'confirmed' => 1,
            $column => $user,
        ]);

        return redirect()->route('delivery.express.myDeliveries');
    }


    public function myDeliveries()
    {
        $role_level = Auth::user()->role->level;
        $user = Auth::user();

        if ($role_level == 5) {
            $comercial = DeliveryExpress::with('service', 'route', 'driver', 'user', 'commerce', 'payment')
                ->where(['commerce_id' => $user->commerce->id])->where('status', '!=', 'cancelled')->get();
            return view('app.delivery-express.delivery-list.sender.sender', compact('role_level', 'comercial'));
        }

        $personal = DeliveryExpress::where(['user_id' => $user->id])->get();

        return view('app.delivery-express.delivery-list.sender.sender', compact('role_level', 'personal'));
    }

    public function drivers($id)
    {

        $deliveryExpress = DeliveryExpress::with('route')->first();
        $drivers = User::with('location')->where('role_id', 4)->get();

        return view('app.delivery-express.delivery-list.receptor.drivers.index', compact('deliveryExpress', 'drivers'));
    }

    public function detail($id)
    {
        $delivery = DeliveryExpress::with('service', 'route', 'driver', 'user', 'commerce', 'payment')->find($id);
        $role_level = Auth::user()->role->level;

        return view('app.delivery-express.detail', compact('delivery', 'role_level'));
    }

    public function assign(Request $request)
    {
        $this->validate(
            $request,
            [
                'driver_id' => 'required|exists:users,id',
                'id' => 'required|exists:delivery_expresses,id',
            ],
            [
                'driver_id.required' => 'Debe seleccionar un conductor',
                'driver_id.exists' => 'El conductor seleccionado no existe',
                'id.required' => 'Debe seleccionar un envio',
                'id.exists' => 'El envio seleccionado no existe',
            ]
        );

        $delivery = DeliveryExpress::find($request->id);
        $delivery->update([
            'driver_id' => $request->driver_id,
            'status' => 'asignado'
        ]);

        return redirect()->route('delivery.express.index')->with('success', 'Envio asignado correctamente');
    }

    public function accept($id)
    {
        $driver_id = Auth::user()->id;
        $delivery = DeliveryExpress::find($id);

        if($delivery->driver_id != $driver_id){
            return redirect()->route('delivery.express.index')->with('error', 'No puedes aceptar este envio');
        }

        $delivery->update(['status' => 'En camino']);

        return redirect()->route('delivery.express.index')->with('success', 'Envio aceptado correctamente');
    }

    public function delivered($id)
    {
        $driver_id = Auth::user()->id;
        $delivery = DeliveryExpress::find($id);

        if($delivery->driver_id != $driver_id){
            return redirect()->route('delivery.express.index')->with('error', 'No puedes Entregar este envio');
        }

        $delivery->update(['status' => 'Entregado']);

        return redirect()->route('delivery.express.index')->with('success', 'Envio aceptado correctamente');
    }

    public function pay($id)
    {
        $payment_options = Commerce_payment_method::with('paymentMethod', 'commerce')->where(['commerce_id' => 1])->get();
        $delivery = DeliveryExpress::with('service', 'route', 'driver', 'user', 'commerce')->find($id);
        $rate = Rate::orderBy('id', 'desc')->first();
        $amount = $delivery->amount * $rate->rate;

        foreach ($payment_options as $payment_option) {
            $DataBank[$payment_option->paymentMethod->target_table] = $this->DataBank($payment_option->payment_option_id, $payment_option->commerce_id);
        }

        return view('app.delivery-express.pay', compact('delivery', 'DataBank', 'amount', 'rate', 'payment_options'));
    }

    public function paid(PaymentRequest $request)
    {
        $user_id = Auth::user()->id;

        $history_payment = History_payment::create([
            'user_id' => $user_id,
            'commerce_id' => 1,
            'payment_option_id' => $request->payment_option_id,
            'amount' => $request->amount,
            'reference' => $request->reference,
            'express_id' => $request->express_id,
            'currency_id' => $request->currency_id
        ]);

        return redirect()->route('delivery.express.myDeliveries');
    }

    public function delete(Request $request)
    {
        $delivery = DeliveryExpress::find($request->id);
        $delivery->update(['status' => 'cancelled']);

        return redirect()->route('delivery.express.myDeliveries');
    }


    private function fee($distance, $service)
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

    private function DataBank($paymentOption, $commerce_id)
    {
        if ($paymentOption == 3) {
            $data = Mobile_payment::with('bank')->where(['commerce_id' => $commerce_id])->get();
            return $data;
        } else if ($paymentOption == 4) {
            $data = Transfer_payment::with('bank')->where(['commerce_id' => $commerce_id])->get();
            return $data;
        } else if ($paymentOption == 5) {
            $data = Zelle_payment::with('bank')->where(['commerce_id' => $commerce_id])->get();
            return $data;
        }

        return false;
    }
}
