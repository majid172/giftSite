<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('checkout', compact('cart', 'total'));
    }

    /**
     * Handle the order placement.
     */
    public function store(Request $request)
    {
        // Validate shipping info
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        // Process Order (Simulated)
        // In a real app, you would save order to DB here.

        // Clear Cart
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Thank you! Your order has been placed successfully.');
    }
}
