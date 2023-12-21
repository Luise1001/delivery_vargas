<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Sent_code;

class LoginController extends Controller
{
    public function index():View
    {
        return view('app.index');
    }

    public function login(LoginRequest $request):RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

       if( Auth::attempt($credentials))
       {
              return redirect()->route('home.index');
       }
       else
       {
          return redirect()->route('app.index')->withErrors(['error' => 'Las credenciales no coinciden']);
       }
    }

    public function register():View
    {
        return view('app.register');
    }

    public function code(RegisterRequest $request):View
    {
        $code = $this->generateCode($request->email, 'Código de verificación', 'Su código de verificación es:');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
            'role_id' => 6
        ]);
        
        return view('app.code');
    }

    public function store(Request $request):RedirectResponse
    {

        $code = Sent_code::where('code', $request->code)->first();

        

        if($code)
        {
            $user = User::where('email', $code->destination)->latest();
            if($user)
            {
                return redirect()->route('app.index')->with('success', 'Usuario registrado correctamente');
            }
            else
            {
                return redirect()->route('app.index')->withErrors(['error' => 'El código no coincide']);
            }
            
        }
        else
        {
            $user = User::latest()->first();
            $user->delete();
            return redirect()->route('app.index')->withErrors(['error' => 'El código no coincide']);
        }
    }

    public function reset():View
    {
        return view('app.reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ],
        [
            'email.required' => 'El correo es requerido',
            'email.exists' => 'El correo no existe en nuestra base de datos'
        ]);

       $code = $this->generateCode($request->email, 'Clave temporal', 'Su clave temporal es:');
       $user = User::where('email', $request->email)->first();
       $user->password = Hash::make($code);
       $user->save();

       return redirect()->route('app.index')->with('success', 'Se ha enviado un correo con su clave temporal');

    }
    
    public function logout():RedirectResponse
    {
        Auth::logout();
        return redirect()->route('app.index');
    }

    public function generateCode($destination, $title, $message):string
    {
        $code = rand(100000, 999999);

        Sent_code::create([
            'code' => $code,
            'destination' => $destination
        ]);

        //mail($destination, $title, $title . $code);
        return $code;
    }
}
