<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commerce;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 6)->orderBy('updated_at', 'DESC')->get();
        $commerces = User::where('role_id', 5)->orderBy('updated_at', 'DESC')->get();
        $drivers = User::where('role_id', 4)->orderBy('updated_at', 'DESC')->get();
        $admins = User::where('role_id', 2)->orderBy('updated_at', 'DESC')->get();

        return view('app.users.index', compact('users', 'commerces', 'drivers', 'admins'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('app.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required',
                'role' => 'required'
            ],
            [
                'id.required' => 'El id es requerido',
                'role.required' => 'El rol es requerido'
            ]
        );

        $user = User::find($request->id);
        $user->role_id = $request->role;
        $user->save();


        return redirect()->route('user.list.index');
    }
}
