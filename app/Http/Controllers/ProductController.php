<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // All active products for the products page
        $products = Product::where('active', true)->latest()->get();
        return view('products', compact('products'));
    }

    public function home()
    {
        // Latest 8 active products for the home page
        $products = Product::where('active', true)->latest()->take(8)->get();
        return view('index', compact('products'));
    }
}