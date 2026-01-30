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

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

    public function invoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('orders.invoice', compact('order')); // Reusing the same invoice view
    }
}
