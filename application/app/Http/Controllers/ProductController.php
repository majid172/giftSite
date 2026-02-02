<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
             $query->latest();
        }

        $products = $query->with('reviews')->get();
        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'category', 'reviews.user' => function($query) {
             $query->select('id', 'name'); // Select only necessary columns
        }])->findOrFail($id);
        
        // Products from same category (More from this collection)
        $relatedProducts = Product::where('status', 1)
            ->where('id', '!=', $id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Other Categories with products (Explore more)
        $otherCategories = Category::where('id', '!=', $product->category_id)
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
