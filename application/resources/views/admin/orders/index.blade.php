@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--receipt] size-6"></span>
            Orders
        </div>
        <!-- Optional: Add filters or buttons here if needed later -->
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="section-card">
        <div class="card-header">
            <span>All Orders</span>
            <span class="text-xs font-normal text-slate-500 ml-2">- Manage customer orders</span>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="font-bold text-blue-700 hover:text-blue-900">
                                    {{ $order->order_id }}
                                </a>
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                                <div class="text-xs text-slate-500">{{ $order->shipping_address['email'] ?? 'N/A' }}</div>
                            </td>
                            <td class="text-slate-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td>
                                @php
                                    $statusClass = 'badge-blue';
                                    if(in_array($order->status, ['Received', 'Completed', 'Finalizing'])) $statusClass = 'badge-green';
                                    elseif($order->status === 'Canceled') $statusClass = 'badge-red';
                                    elseif($order->status === 'Invoiced') $statusClass = 'badge-blue';
                                    elseif($order->status === 'Downloaded') $statusClass = 'badge-gray';
                                    elseif($order->status === 'Pending') $statusClass = 'badge-gray'; // Or warning color if you have badge-yellow
                                @endphp
                                <span class="badge {{ $statusClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="font-bold text-slate-800">
                                ${{ number_format($order->price, 2) }}
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="action-btn" title="Edit Order">
                                        <span class="icon-[tabler--pencil] size-4.5"></span>
                                    </a>
                                    <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="action-btn" title="View Invoice">
                                        <span class="icon-[tabler--file-invoice] size-4.5"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                        <span class="icon-[tabler--receipt-off] size-8"></span>
                                    </div>
                                    <div class="text-slate-500 font-medium">No orders found</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
