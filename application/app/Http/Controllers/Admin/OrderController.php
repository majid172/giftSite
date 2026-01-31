<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('order_id') && $request->order_id != '') {
            $query->where('order_id', 'like', '%' . $request->order_id . '%');
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->simplePaginate(15)->appends($request->all());
        
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $order = Order::with('items')->findOrFail($id);
        $originalStatus = strtolower($order->status);
        $newStatus = strtolower($request->status);

        // Update status
        $order->update([
            'status' => $request->status,
        ]);

        // Logic for stock management
        if ($originalStatus !== 'delivered' && $newStatus === 'delivered') {
            // Deduct stock
            foreach ($order->items as $item) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        } elseif ($originalStatus === 'delivered' && $newStatus !== 'delivered') {
            // Restore stock (if accidentally marked as delivered)
            foreach ($order->items as $item) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

    public function invoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('orders.invoice', compact('order')); // Reusing the same invoice view
    }
}
