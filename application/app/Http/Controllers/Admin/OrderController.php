<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

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
            'shipping_cost' => 'nullable|numeric|min:0',
        ]);

        $order = Order::with('items')->findOrFail($id);
        $originalStatus = strtolower($order->status);
        $newStatus = strtolower($request->status);

        $data = [
            'status' => $request->status,
        ];

        if ($request->has('shipping_cost') && $request->shipping_cost !== null) {
            $oldShipping = $order->shipping_cost;
            $newShipping = $request->shipping_cost;

            if ($oldShipping != $newShipping) {
                $subtotal = $order->price - $oldShipping;
                $data['shipping_cost'] = $newShipping;
                $data['price'] = $subtotal + $newShipping;
            }
        }

        $order->update($data);

        if ($originalStatus !== 'approved' && $newStatus === 'approved') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        } 
        $approvedStatuses = ['approved', 'ready to ship', 'shipped', 'delivered'];
        $cancelledStatuses = ['cancelled', 'returned', 'refund processing'];
        
        if (in_array($originalStatus, $approvedStatuses) && in_array($newStatus, $cancelledStatuses)) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }
        if ($originalStatus === 'approved' && $newStatus === 'pending') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
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
