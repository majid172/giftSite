@extends('admin.layouts.app')

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600;">Orders</h2>
        <div style="color: var(--text-muted); font-size: 0.875rem;">Manage customer orders</div>
    </div>
</div>

@if(session('success'))
<div style="background-color: #ECFDF5; border: 1px solid #10B981; color: #047857; padding: 12px; border-radius: var(--radius); margin-bottom: 20px;">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" style="font-weight: 600; color: var(--primary);">
                            #{{ $order->order_id }}
                        </a>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->shipping_address['email'] ?? 'N/A' }}</div>
                    </td>
                    <td style="color: var(--text-muted);">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td>
                        @php
                            $badgeClass = 'badge-secondary';
                            if(in_array($order->status, ['Received', 'Completed', 'Finalizing', 'Invoiced'])) $badgeClass = 'badge-success';
                            elseif($order->status === 'Canceled') $badgeClass = 'badge-danger';
                            elseif($order->status === 'Pending') $badgeClass = 'badge-warning';
                            elseif($order->status === 'Downloaded') $badgeClass = 'badge-info';
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="font-weight: 600;">
                        ${{ number_format($order->price, 2) }}
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-outline btn-icon" style="padding: 4px 8px;" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-outline btn-icon" style="padding: 4px 8px;" title="Invoice">
                            <i class="ti ti-file-invoice"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; color: var(--text-muted);">
                            <i class="ti ti-receipt-off" style="font-size: 2rem;"></i>
                            <span>No orders found</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
    <div style="padding-top: 20px;">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
