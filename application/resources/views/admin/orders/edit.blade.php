@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Edit Order: {{ $order->order_id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost">
        <span class="icon-[tabler--arrow-left] size-5"></span>
        Back to Orders
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Status Update Card -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title mb-4">Update Status</h2>
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Order Status</span>
                    </label>
                    <select name="status" class="select select-bordered w-full">
                        @foreach(['Pending', 'Processing', 'Shipped', 'Completed', 'Canceled', 'Finalizing'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="card-actions justify-end">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Order Details Card -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title mb-4">Order Details</h2>
            <div class="space-y-2">
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Customer:</strong> {{ $order->user ? $order->user->name : 'Guest' }}</p>
                <p><strong>Email:</strong> {{ $order->shipping_address['email'] ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $order->shipping_address['phone'] ?? 'N/A' }}</p>
                <div class="divider"></div>
                <h3 class="font-bold">Shipping Address</h3>
                <p>
                    {{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}<br>
                    {{ $order->shipping_address['address'] }}<br>
                    {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['zip'] }}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Items Card -->
    <div class="card bg-base-100 shadow-xl md:col-span-2">
        <div class="card-body">
            <h2 class="card-title mb-4">Ordered Items</h2>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-bold">Total:</td>
                            <td class="font-bold">${{ number_format($order->price, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
