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

        // Calculate Shipping Cost (Default to 0 or first option)
        $shippingRates = [
            'inside_dhaka' => (float) get_setting('shipping_inside_dhaka', 60),
            'outside_dhaka' => (float) get_setting('shipping_outside_dhaka', 120),
            'sub_inside_dhaka' => (float) get_setting('shipping_sub_inside_dhaka', 80),
        ];

        // Default to inside dhaka for initial view calculation if needed, or 0
        $shippingCost = 0; 

        $total = $subtotal + $shippingCost;

        return view('checkout', compact('cart', 'subtotal', 'shippingCost', 'total', 'shippingRates'));
    }

    /**
     * Handle the order placement.
     */
    public function store(Request $request)
    {
        // Validate shipping info
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'shipping_method' => 'required|in:inside_dhaka,outside_dhaka,sub_inside_dhaka',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Calculate Shipping Cost based on selection
        $shippingRates = [
            'inside_dhaka' => (float) get_setting('shipping_inside_dhaka', 60),
            'outside_dhaka' => (float) get_setting('shipping_outside_dhaka', 120),
            'sub_inside_dhaka' => (float) get_setting('shipping_sub_inside_dhaka', 80),
        ];

        $shippingMethod = $request->shipping_method;
        $shippingCost = $shippingRates[$shippingMethod] ?? 0;

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
