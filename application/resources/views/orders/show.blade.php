@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Order Details: {{ $order->order_id }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> {{ $order->status }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    
                    <h5 class="mt-4">Items</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th>${{ number_format($order->price, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p>
                        {{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}<br>
                        {{ $order->shipping_address['address'] }}<br>
                        {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['zip'] }}<br>
                        Phone: {{ $order->shipping_address['phone'] ?? 'N/A' }}
                    </p>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-body">
                     <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-secondary btn-block" target="_blank">Download Invoice</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
