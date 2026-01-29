<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'category'])->findOrFail($id);
        
        // Products from same category (More from this collection)
        $relatedProducts = Product::where('status', 1)
            ->where('id', '!=', $id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Other Categories with products (Explore more)
        $otherCategories = \App\Models\Category::where('id', '!=', $product->category_id)
            ->whereHas('products')
            ->inRandomOrder()
            ->limit(2)
            ->with(['products' => function($query) {
                $query->where('status', 1)->inRandomOrder()->limit(4);
            }])
            ->get();
            
        return view('product', compact('product', 'relatedProducts', 'otherCategories'));
    }
}
