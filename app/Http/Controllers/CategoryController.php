<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\Commerce_category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $commerce = Commerce::where('user_id', Auth::user()->id)->first();
        if(!$commerce)
        {
          return redirect()->route('commerce.myCommerce');
        }

        $MyCategories = Commerce_category::with('category')->where('commerce_id', $commerce->id)->get();
        $categories = Category::all();

        $filteredCategories = $categories->filter(function ($category) use ($MyCategories) {
            return !$MyCategories->contains('category_id', $category->id);
        });

        $categories = $filteredCategories;
        

        return view('app.categories.index', compact('MyCategories', 'categories'));
    }

    public function update(Request $request)
    {
        $commerce_id = Auth::user()->commerce->id;
        $categories = json_decode($request->categories);
        $request->merge(['categories' => $categories, 'commerce_id' => $commerce_id]);

        $this->validate(
            $request,
            [
                'categories' => 'required|array|min:1',
            ],
            [
                'categories.required' => 'Debe seleccionar al menos una categoria',
            ]
        );

        Commerce_category::where('commerce_id', $commerce_id)->delete();

        foreach ($categories as $category) {
            Commerce_category::Create([
                'commerce_id' => $commerce_id,
                'category_id' => $category->category_id
            ]);
        }

        return redirect()->route('commerce.category.index');
    }
}
