<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::all();

        return view('app.fees.index', compact('fees'));
    }

    public function create()
    {
        return view('app.fees.create');
    }

    public function store(FeeRequest $request)
    {
        $user_id = Auth::user()->id;
        $request->merge(['created_by' => $user_id]);

        Fee::create($request->all());

        return redirect()->route('fee.index');
    }

    public function edit($id)
    {
        $fee = Fee::find($id);

        return view('app.fees.edit', compact('fee'));
    }

    public function update(FeeRequest $request)
    {
        $fee = Fee::find($request->id);
        $user_id = Auth::user()->id;
        
        if(!$request->special)
        {
            $request->merge(['special' => 0]);
        }
        $request->merge(['created_by' => $user_id]);

        $fee->update($request->all());

        return redirect()->route('fee.index');
    }

    public function delete(Request $request)
    {
        $fee = Fee::find($request->id);

        $fee->delete();

        return redirect()->route('fee.index');
    }


}
