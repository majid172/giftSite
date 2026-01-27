@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Orders</h1>
</div>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="hover">
                    <td class="font-bold">{{ $order->order_id }}</td>
                    <td>
                        <div class="font-bold">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                        <div class="text-xs opacity-50">{{ $order->shipping_address['email'] ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="badge badge-{{ $order->status === 'Completed' ? 'success' : ($order->status === 'Pending' ? 'warning' : 'neutral') }}">
                            {{ $order->status }}
                        </div>
                    </td>
                    <td class="font-medium">${{ number_format($order->price, 2) }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-info btn-circle" aria-label="Edit Status">
                            <span class="icon-[tabler--pencil] size-5"></span>
                        </a>
                        <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-sm btn-ghost btn-circle" aria-label="Invoice">
                            <span class="icon-[tabler--file-invoice] size-5"></span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-base-content/70">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
