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
        $latestProds = Product::latest()->take(4)->get();
        
        return view('welcome', compact('latestProds', 'categories'));
    }
}
