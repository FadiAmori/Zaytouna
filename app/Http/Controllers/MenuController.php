<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    public function menuPartial(Request $request)
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->when($request->category, function($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->get();
        return view('partials.menu', compact('categories', 'products'))->render();
    }
}
