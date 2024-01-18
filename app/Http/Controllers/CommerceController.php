<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyCommerceRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Commerce;


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
 
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = "profile.jpg";
            $destinationPath = $this->GeneratePath($user_id);
            $image = Image::make($image)->save($destinationPath . '/' . $name, 75);
            //$image->move($destinationPath, $name);
            $request->merge(['photo' => true]);
        }else {
            $request->merge(['photo' => false]);
        }
        
        Commerce::updateOrCreate(
            ['user_id' => $user_id],
            [
                'photo' => $request->photo,
                'document_type' => $request->document_type,
                'document' => $request->document,
                'name' => $request->name,
                'phone' => $request->phone
            ]
        );

        return redirect()->route('commerce.myCommerce');
    }

    private function GeneratePath($user_id)
    {
        $path = public_path('/assets/storage/profile/commerces/' . $user_id . '/photo');
        if(!File::exists($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
