<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Validation\Rule;
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
        $user_id = Auth::user()->id;
        $commerce = Commerce::where('user_id', $user_id)->first();  
        if(!$commerce)
        {
          return redirect()->route('commerce.myCommerce');
        }

        $available_products = Product::with('commerce', 'stock')
        ->where(['commerce_id' => $commerce->id, 'disabled' => false])
        ->whereHas('stock', function ($query) {
            $query->where('quantity', '>', 0);
        })
        ->get();

        $unavailable_products = Product::with('commerce', 'stock')
        ->where(['commerce_id' => $commerce->id, 'disabled' => false])
        ->whereHas('stock', function ($query) {
            $query->where('quantity', '<', 1);
        })
        ->get();
    
        $disabled_products = Product::with('commerce', 'stock')->where(['commerce_id'=> $commerce->id, 'disabled'=> true])->get();

        return view('app.products.index', compact('available_products', 'unavailable_products', 'disabled_products'));
    }

    public function detail($id)
    {
        $product = Product::with('commerce', 'stock')->find($id);

        return view('app.products.detail', compact('product'));
    }

    public function create()
    {
        return view('app.products.create');
    }

    public function store(ProductRequest $request)
    {
        $this->validate($request, [
            'code' => 'unique:products',
        ], [
            'code.unique' => 'El código ya existe',
        ]);

        $commerce_id = Auth::user()->commerce->id;
        $request->merge(['commerce_id' => $commerce_id]);
        $request->merge(['full_price', round($request->full_price, 2)]);
        $price = $request->full_price;

        if (!$request->tax) {
            $price = round($price / 1.16, 2);
            $request->merge(['tax' => 1, 'price' => $price]);
        } else {
            $request->merge(['tax' => 0, 'price' => $price]);
            $request->merge(['price' => $price]);
        }

        if ($request->hasFile('image')) {
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

    public function edit($id)
    {
        $product = Product::with('stock')->find($id);

        return view('app.products.edit', compact('product'));
    }

    public function update(ProductRequest $request)
    {
        $this->validate($request, [
            'code' => [Rule::unique('products')->ignore($request->code, 'code')]
        ], [
            'code.unique' => 'El código ya existe',
        ]);

        $commerce_id = Auth::user()->commerce->id;
        $request->merge(['commerce_id' => $commerce_id]);
        $request->merge(['full_price', round($request->full_price, 2)]);
        $price = $request->full_price;

        if (!$request->tax) {
            $price = round($price / 1.16, 2);
            $request->merge(['tax' => 1, 'price' => $price]);
        } else {
            $request->merge(['tax' => 0, 'price' => $price]);
            $request->merge(['price' => $price]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = "$request->code.jpg";
            $destinationPath = $this->GeneratePath($commerce_id);
            $image = Image::make($image)->save($destinationPath . '/' . $name, 75);
            //$image->move($destinationPath, $name);
            $request->merge(['photo' => true]);
        }

        $product = Product::find($request->id);
        $product->update($request->all());
        $product->stock->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('commerce.product.index');
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->update(['disabled' => true]);

        return redirect()->route('commerce.product.index');
    }

    private function GeneratePath($commerce_id)
    {
        $path = public_path('/assets/storage/products/commerces/' . $commerce_id . '/products');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
