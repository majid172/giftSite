<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch categories (limit to 3 for the design)
        $categories = Category::take(3)->get();

        // Fetch latest 4 products for the "Latest Arrivals" section
        $latestProds = Product::withAvg('reviews', 'rating')->withCount('reviews')->latest()->take(4)->get();

        // Fetch 3 random products for "Bestselling Products"
        $bestSellingProducts = Product::withAvg('reviews', 'rating')->withCount('reviews')->inRandomOrder()->take(3)->get();

        // Fetch 6 featured products
        $featuredProducts = Product::withAvg('reviews', 'rating')->withCount('reviews')->where('is_featured', 1)->take(6)->get();
        
        return view('welcome', compact('latestProds', 'categories', 'bestSellingProducts', 'featuredProducts'));
    }
}
