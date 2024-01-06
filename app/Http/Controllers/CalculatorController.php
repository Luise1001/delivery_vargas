<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('app.calculator.index');
    }

    public function fee(Request $request)
    {
        $distance = $request->distance;
        $service = $request->service;

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
