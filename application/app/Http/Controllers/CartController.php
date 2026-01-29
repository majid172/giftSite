<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart', compact('cart', 'total'));
    }

    /**
     * Add an item to the cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $request->name,
                "quantity" => $request->quantity ?? 1,
                "price" => $request->price,
                "image" => $request->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the cart.
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            // Calculate new totals
            $itemSubtotal = $cart[$request->id]['price'] * $request->quantity;
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 10); // Start with 0 or however initialized

            // Actually, let's copy exactly what works, assuming $total calculation logic is consistent.
            // Re-calculating $total:
            $total = 0;
            foreach($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            session()->flash('success', 'Cart updated successfully');

            return response()->json([
                'success' => true,
                'item_subtotal' => number_format($itemSubtotal, 2),
                'total' => number_format($total, 2)
            ]);
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully');
    }
}
