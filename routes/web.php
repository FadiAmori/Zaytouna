
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Models\Category;
use App\Models\Product;

Route::get('/menu-partial', [MenuController::class, 'menuPartial']);

Route::get('/', function () {
    $categories = Category::all();
    $products = Product::with('category')
        ->when(request('category'), function($query) {
            $query->where('category_id', request('category'));
        })
        ->get();
    return view('home', compact('categories', 'products'));
});

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
