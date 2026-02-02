@extends('admin.layouts.app')

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600;">Order Details</h2>
        <div style="color: var(--text-muted); font-size: 0.875rem;">
            Order #{{ $order->order_id ?? $order->id }} &bull; Placed on {{ $order->created_at->format('M d, Y h:i A') }}
        </div>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-outline">
            <i class="ti ti-file-invoice"></i> Print Invoice
        </a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
    </div>
</div>

@if(session('success'))
<div style="background-color: #ECFDF5; border: 1px solid #10B981; color: #047857; padding: 12px; border-radius: var(--radius); margin-bottom: 20px;">
    {{ session('success') }}
</div>
@endif

<div class="flex flex-col lg:flex-row gap-6">
    <!-- Left Column -->
    <div class="w-full lg:w-2/3">
        <!-- Order Items -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">Order Items</span>
                <span style="font-size: 0.75rem; background: var(--bg-body); padding: 4px 10px; border-radius: 999px; font-weight: 600;">{{ $order->items->count() }} Items</span>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align: center;">Price</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div style="width: 48px; height: 48px; border-radius: var(--radius); background: #f8fafc; border: 1px solid var(--border-color); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                        @if($item->product && $item->product->image)

                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="ti ti-photo" style="color: var(--text-muted);"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: var(--text-main);">{{ $item->product_name }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">SKU: {{ $item->product_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;">${{ number_format($item->price, 2) }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right; font-weight: 600;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Order Status & Totals -->
            <div style="padding: 24px 0 0 0; margin-top: 24px; border-top: 1px solid var(--border-color); display: flex; gap: 30px; flex-wrap: wrap;">
                
                <!-- Status & Shipping Update -->
                <div style="flex: 1; min-width: 250px;">
                    <label class="form-label">Update Order Details</label>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                        @csrf
                        @method('PUT')
                        
                        <div style="display: flex; gap: 10px;">
                            <div style="flex: 1;">
                                <label style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 4px; display: block;">Status</label>
                                <select name="status" class="form-control">
                                    @foreach(['Pending', 'Approved', 'Ready to Ship', 'Shipped', 'Delivered', 'Cancelled', 'Returned', 'Refund Processing'] as $status)
                                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                        </div>

                        <button type="submit" class="btn btn-primary" style="align-self: flex-start;">Update Order</button>
                    </form>
                </div>

                <!-- Totals -->
                <div style="flex: 1; min-width: 250px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                        <span style="color: var(--text-muted);">Subtotal</span>
                        <span style="font-weight: 600;">${{ number_format($order->price - $order->shipping_cost, 2) }}</span>
                    </div>
                   
                    <div style="display: flex; justify-content: space-between; margin-top: 8px; padding-top: 12px; border-top: 1px solid var(--border-color);">
                        <span style="font-weight: 600; font-size: 1rem;">Total</span>
                        <span style="font-weight: 700; font-size: 1.25rem; color: var(--success);">${{ number_format($order->price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info -->
    <div class="w-full lg:w-1/3">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Customer Details</span>
                <span class="badge" style="background: var(--bg-body); color: var(--text-muted);">
                    {{ $order->user ? 'Registered' : 'Guest' }}
                </span>
            </div>

            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.25rem;">
                    @if($order->user && $order->user->image)
                        <img src="{{ asset($order->user->image) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        {{ substr($order->user ? $order->user->name : 'G', 0, 1) }}
                    @endif
                </div>
                <div>
                    <div style="font-weight: 600;">{{ $order->user ? $order->user->name : 'Guest Customer' }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->shipping_address['email'] ?? 'No Email' }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">ID: #{{ $order->user_id ?? 'N/A' }}</div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; gap: 12px;">
                    <div style="width: 32px; height: 32px; border-radius: var(--radius); background: #f8fafc; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                        <i class="ti ti-phone"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Phone</div>
                        <div style="font-size: 0.875rem;">{{ $order->shipping_address['phone'] ?? 'N/A' }}</div>
                    </div>
                </div>

                <div style="display: flex; gap: 12px;">
                    <div style="width: 32px; height: 32px; border-radius: var(--radius); background: #f8fafc; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Shipping Address</div>
                        <div style="font-size: 0.875rem; line-height: 1.4;">
                            {{ $order->shipping_address['address'] ?? '' }}<br>
                            {{ $order->shipping_address['city'] ?? '' }} {{ isset($order->shipping_address['zip']) ? '- ' . $order->shipping_address['zip'] : '' }}<br>
                            <strong>{{ $order->shipping_address['country'] ?? 'USA' }}</strong>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 12px;">
                     <div style="width: 32px; height: 32px; border-radius: var(--radius); background: #f8fafc; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                        <i class="ti ti-calendar"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Joined</div>
                        <div style="font-size: 0.875rem;">{{ $order->user ? $order->user->created_at->format('M Y') : 'N/A' }}</div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-color); text-align: center;">
                <a href="#" style="font-size: 0.875rem; font-weight: 600; color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                    View Full Profile <i class="ti ti-arrow-right" style="font-size: 1rem;"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
