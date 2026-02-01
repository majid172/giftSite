<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->back()->with('error', 'Administrators cannot submit reviews.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
            'guest_name' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($productId);
        
        $userId = auth()->id();
        // Require name for guests if you want, or default to 'Guest'
        $guestName = $request->guest_name;
        if(!$userId && empty($guestName)) {
             $guestName = 'Guest';
        }

        Review::create([
            'user_id' => $userId,
            'guest_name' => $guestName,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
