<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commerce_category;

class BuyController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'commerce')->get();

        return view('app.buy.index', compact('categories'));
    }

    public function commerce($category, $id)
    {
      $commerce_list = Commerce_category::with('commerce')->where('category_id', $id)->get();

      if(!$commerce_list){
        return view('app.buy.commerce-list', compact('category'))->with('error', 'No hay comercios disponibles');
      }

      return view('app.buy.commerce-list', compact('category', 'commerce_list'));
    }

    public function products($commerce, $id)
    {
      return view('app.buy.products', compact('commerce'));
    }
}
