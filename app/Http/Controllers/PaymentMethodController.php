<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentOption;
use App\Models\Commerce;
use App\Models\Commerce_payment_method;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $commerce = Commerce::where('user_id', Auth::user()->id)->first();

        if (!$commerce) {
            return redirect()->route('commerce.myCommerce');
        }

        $myPaymentOptions = Commerce_payment_method::with('paymentMethod')->where('commerce_id', $commerce->id)->get();
        $paymentOptions = PaymentOption::all();

        $filteredOptions = $paymentOptions->filter(function ($option) use ($myPaymentOptions) {
            return !$myPaymentOptions->contains('payment_option_id', $option->id);
        });

        $paymentOptions = $filteredOptions;

        return view('app.payment-methods.index', compact('paymentOptions', 'myPaymentOptions'));
    }

    public function update(Request $request)
    {
        $commerce_id = Auth::user()->commerce->id;
        $paymentOptions = json_decode($request->payment_options);
        $request->merge(['payment_options' => $paymentOptions, 'commerce_id' => $commerce_id]);

        $this->validate(
            $request,
            [
                'payment_options' => 'required|array|min:1',
            ],
            [
                'payment_options.required' => 'Debe seleccionar al menos un método de pago',
            ]
        );

        Commerce_payment_method::where('commerce_id', $commerce_id)->delete();

        foreach ($paymentOptions as $option) {
            Commerce_payment_method::Create([
                'commerce_id' => $commerce_id,
                'payment_option_id' => $option->payment_option_id
            ]);
        }

        return redirect()->route('commerce.payment.method.index');
    }
}
