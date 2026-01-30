<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->back()->with('error', 'Administrators cannot submit reviews.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($productId);

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
