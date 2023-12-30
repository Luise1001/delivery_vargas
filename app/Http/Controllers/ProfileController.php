<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        $photo = $this->GeneratePhoto($request->input_fp, $user_id);

        if($photo)
        {
            $user->update([
                'photo' => true
            ]);
        }
        
        return redirect()->route('profile.index')->with('success', 'Perfil actualizado correctamente');
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

    public function GeneratePhoto($file, $id)
    {    
        if ($file) {
            $route = public_path("assets/storage/profile/users/$id/photo");
            $quality = 30;
        
            if (file_exists($route)) {
                $route .= '/';
                $originalName = $file->getClientOriginalName();
                $img = imagejpeg(imagecreatefromstring(file_get_contents($file->getRealPath())), $route .'perfil.jpg');
        
                return true;
            } else {
                mkdir($route, 0777, true); 
        
                $route .= '/';
                $originalName = $file->getClientOriginalName();
                $img = imagejpeg(imagecreatefromstring(file_get_contents($file->getRealPath())), $route .'perfil.jpg');

                return true;
            }
        } else {
            return false;
        }
        
    }
}
