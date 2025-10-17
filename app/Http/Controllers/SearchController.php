<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Perform a product search and return the products view.
     * Uses ?q=term (GET). Returns paginated results and keeps query string.
     */
    public function search(Request $request)
    {
       
        $q = trim((string) $request->query('q', ''));

        if ($q === '') {
            return redirect()->route('products.index');
        }

        $query = Product::where('active', true)
            ->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%");
            });

        $products = $query->latest()->paginate(9)->withQueryString();

        // Keep same categories data as ProductController@index expects
        $categories = Category::pluck('name');

        return view('products', compact('products', 'categories', 'q'));
    }
}