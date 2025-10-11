<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index(Request $request)
{
    $query = Product::where('active', true);

    // Optional: filter by category
    if ($request->filled('category') && $request->category !== 'Tous') {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('name', $request->category);
        });
    }

    // Paginate — change 9 to the number of products per page you want
    $products = $query->latest()->paginate(9);

    // For the filter buttons
    $categories = Category::pluck('name');

    return view('products', compact('products', 'categories'));
}






    public function home()
    {
        // Latest 8 active products for the home page
        $products = Product::where('active', true)->latest()->take(8)->get();
        return view('index', compact('products'));
    }
}