@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>My Orders</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'Completed' ? 'success' : ($order->status === 'Pending' ? 'warning' : 'secondary') }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>${{ number_format($order->price, 2) }}</td>
                    <td>{{ $order->items->count() }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-secondary" target="_blank">Invoice</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">You have no orders yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
