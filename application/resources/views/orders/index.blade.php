@extends('layouts.app')

@section('title', 'My Orders - GiftPack')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">My Orders</h1>
            <p class="text-lg text-gray-600">Track and manage your premium gift box selections</p>
        </div>

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="p-6 sm:p-8">
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-primary/5 rounded-xl">
                                    <span class="icon-[tabler--package] size-8 text-primary"></span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Order #{{ $order->order_id }}</h3>
                                    <p class="text-sm text-gray-500">Placed on {{ dateFormat($order->created_at, 'd M, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @php
                                    $statusClasses = [
                                        'Pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'Processing' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'Completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'Canceled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                    ];
                                    $currentStatusClass = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold border {{ $currentStatusClass }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                            <div class="md:col-span-1">
                                <p class="text-sm text-gray-500 mb-1">Items</p>
                                <p class="font-semibold text-gray-900">{{ $order->items->count() }} {{ Str::plural('Item', $order->items->count()) }}</p>
                            </div>
                            <div class="md:col-span-1">
                                <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                                <p class="font-bold text-gray-900 text-xl">${{ number_format($order->price, 2) }}</p>
                            </div>
                            <div class="md:col-span-2 flex flex-wrap gap-3 justify-end">
                                <a href="{{ route('orders.show', $order->id) }}" 
                                   class="inline-flex items-center px-6 py-2.5 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition-colors duration-200">
                                    View Details
                                </a>
                                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                                   class="inline-flex items-center px-6 py-2.5 bg-white text-gray-900 border border-gray-200 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                                    <span class="icon-[tabler--file-download] mr-2 size-5"></span>
                                    Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200">
                    <div class="mb-6 inline-block p-4 bg-gray-50 rounded-2xl text-gray-400">
                        <span class="icon-[tabler--package-off] size-16"></span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">No Orders Yet</h2>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">You haven't placed any orders yet. Start exploring our premium gift collection today!</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-lg shadow-primary/20">
                        Start Shopping
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
