<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if($user->role_id == 4)
        {
            return view('app.profile.driver', compact('user'));
        }
        
        return view('app.profile.index', compact('user'));
    }


    public function update(ProfileRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $user->update($request->all());

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = 'profile.jpg';
            $destinationPath = $this->GeneratePath($user_id);
            $image = Image::make($image)->save($destinationPath . '/' . $name, 75);
            //$image->move($destinationPath, $name);
            $user->photo = true;
            $user->save();
        }
        
        return redirect()->route('profile.index');
    }

    public function change()
    {
        return view('app.profile.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ],
        [
        'current_password.required' => 'La contraseña actual es requerida',
        'new_password.required' => 'La nueva contraseña es requerida',
        'confirm_password.required' => 'La confirmación de la contraseña es requerida',
        'confirm_password.same' => 'Las contraseñas no coinciden'
      ]);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if(!Hash::check($request->current_password, $user->password))
        { 
            return redirect()->route('profile.reset.password')->with('error', 'La contraseña actual no coincide');
        }

        $user->update([
            'password' => hash::make($request->new_password)
        ]);

        return redirect()->route('profile.index')->with('success', 'Contraseña actualizada correctamente');
    }

    private function GeneratePath($user_id)
    {
        $path = public_path('/assets/storage/profile/users/' . $user_id . '/photo');
        if(!File::exists($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
