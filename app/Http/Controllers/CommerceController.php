<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyCommerceRequest;
use Illuminate\Http\Request;
use App\Models\Commerce;
use Illuminate\Support\Facades\Auth;

class CommerceController extends Controller
{
    public function index()
    {
        $commerces = Commerce::with('user', 'static_location')->get();

        return view('app.commerces.index', compact('commerces'));
    }

    public function myCommerce()
    {
        $user_id = Auth::user()->id;
        $myCommerce = Commerce::where('user_id', $user_id)->first();

        if (!$myCommerce) {
            $myCommerce = (object) [
                'photo' => '',
                'document_type' => '',
                'document' => '',
                'name' => '',
                'phone' => ''
            ];
        }

        return view('app.commerces.my-commerce', compact('myCommerce'));
    }

    public function update(MyCommerceRequest $request)
    {
        $user_id = Auth::user()->id;
        $photo = $this->GeneratePhoto($request->input_fp, $user_id);

        Commerce::updateOrCreate(
            ['user_id' => $user_id],
            [
                'photo' => $photo,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'name' => $request->name,
                'phone' => $request->phone
            ]
        );

        return redirect()->route('commerce.myCommerce');
    }

    public function GeneratePhoto($file, $id)
    {
        if ($file) {
            $route = public_path("assets/storage/profile/commerces/$id/photo");
            $quality = 30;

            if (file_exists($route)) {
                $route .= '/';
                $originalName = $file->getClientOriginalName();
                $img = imagejpeg(imagecreatefromstring(file_get_contents($file->getRealPath())), $route . 'perfil.jpg');

                return true;
            } else {
                mkdir($route, 0777, true);

                $route .= '/';
                $originalName = $file->getClientOriginalName();
                $img = imagejpeg(imagecreatefromstring(file_get_contents($file->getRealPath())), $route . 'perfil.jpg');

                return true;
            }
        } else {
            return false;
        }
    }
}
