<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Commerce;


class ProductController extends Controller
{
    public function index()
    {
        return view('app.products.index');
    }

    public function create()
    {
        return view('app.products.create');
    }

    public function store(ProductRequest $request)
    {
        $commerce_id = Auth::user()->commerce->id;
        $request->merge(['commerce_id' => $commerce_id]);
        $price = $request->full_price;

        if (!$request->tax) {
            $price = round($price / 1.16, 2);
            $request->merge(['tax' => 1, 'price' => $price]);
        }else{
            $request->merge(['tax' => 0, 'price' => $price]);
            $request->merge(['price'=> $price]);
        }

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = "$request->code.jpg";
            $destinationPath = $this->GeneratePath($commerce_id);
            $image = Image::make($image)->save($destinationPath . '/' . $name, 75);
            //$image->move($destinationPath, $name);
            $request->merge(['photo' => true]);
        }

        $product = Product::create($request->all());
        Stock::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'commerce_id' => $commerce_id
        ]);

        return redirect()->route('commerce.product.index');
    }

    public function edit()
    {
        return view('app.products.edit');
    }

    public function update(Request $request)
    {
        //
    }

    public function delete()
    {
        //
    }

    private function GeneratePath($commerce_id)
    {
        $path = public_path('/assets/storage/products/commerces/' . $commerce_id . '/products');
        if(!File::exists($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
