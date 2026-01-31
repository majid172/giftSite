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

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Calculate Shipping Cost
        $shippingType = get_setting('shipping_type', 'flat_rate');
        $shippingCost = 0;

        if ($shippingType === 'flat_rate') {
            $shippingCost = (float) get_setting('shipping_flat_rate', 0);
        }
        // Add logic for other shipping types here if needed

        $total = $subtotal + $shippingCost;

        return view('checkout', compact('cart', 'subtotal', 'shippingCost', 'total'));
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
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Calculate Shipping Cost
        $shippingType = get_setting('shipping_type', 'flat_rate');
        $shippingCost = 0;

        if ($shippingType === 'flat_rate') {
            $shippingCost = (float) get_setting('shipping_flat_rate', 0);
        }

        $total = $subtotal + $shippingCost;

        // Process Order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(), // This will be null if guest
            'order_id' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'Pending',
            'price' => $total, // Total now includes shipping
            'shipping_cost' => $shippingCost,
            'is_paid' => false, // Default to unpaid for COD
            'shipping_address' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip,
                'phone' => $request->phone,
            ],
            'payment_method' => 'cod', // Defaulting to COD as per migration default
        ]);

        foreach ($cart as $id => $details) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $details['name'],
                'price' => $details['price'],
                'quantity' => $details['quantity'],
                'attributes' => [], // Add if cart has attributes
            ]);
        }

        // Clear Cart
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Thank you! Your order has been placed successfully. Order ID: ' . $order->order_id);
    }
}
