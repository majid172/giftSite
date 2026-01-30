@extends('layouts.app')

@section('title', 'Order Details #' . $order->order_id . ' - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li><a href="{{ route('orders.index') }}" class="hover:text-primary transition-colors">My Orders</a></li>
                        <li><span class="icon-[tabler--chevron-right] size-4"></span></li>
                        <li class="font-medium text-gray-900">Order #{{ $order->order_id }}</li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-extrabold text-gray-900">Order #{{ $order->order_id }}</h1>
                <p class="text-gray-500 mt-1">Placed on {{ dateFormat($order->created_at, 'd M, Y \a\t h:i A') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                   class="inline-flex items-center px-6 py-2.5 bg-white text-gray-900 border border-gray-200 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                    <span class="icon-[tabler--printer] mr-2 size-5"></span>
                    Print Invoice
                </a>
                <a href="{{ route('orders.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition-colors duration-200 shadow-sm">
                    Back to Orders
                </a>
            </div>
        </div>

        <!-- Status Tracker -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Order Status</h3>
            @php
                // Define the sequential progress flow
                $progressFlow = ['Pending', 'Approved', 'Ready to Ship', 'Shipped', 'Delivered'];
                
                // Determine current step index
                $currentIndex = array_search($order->status, $progressFlow);
                
                // Handle non-sequential statuses (Cancelled, Returned, Refund Processing)
                $isNonSequential = false;
                if ($currentIndex === false) {
                    $isNonSequential = true;
                    // If status is Cancelled, Returned, etc., we show a simplified or specific view
                    // For now, let's just map them effectively or show a danger state
                    if (in_array($order->status, ['Cancelled', 'Returned', 'Refund Processing'])) {
                         $progressFlow = ['Pending', $order->status];
                         $currentIndex = 1;
                    } else {
                        // Fallback
                        $currentIndex = 0; 
                    }
                }
            @endphp
            <div class="relative">
                <div class="absolute top-5 left-0 w-full h-0.5 bg-gray-100"></div>
                <div class="relative flex justify-between">
                    @foreach($progressFlow as $index => $status)
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center z-10 
                                {{ $index <= $currentIndex ? (in_array($order->status, ['Cancelled', 'Returned', 'Refund Processing']) ? 'bg-rose-500 text-white' : 'bg-primary text-white') : 'bg-white border-2 border-gray-100 text-gray-400' }}">
                                @if($index < $currentIndex)
                                    <span class="icon-[tabler--check] size-6"></span>
                                @else
                                    <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                @endif
                            </div>
                            <span class="mt-2 text-sm font-semibold {{ $index <= $currentIndex ? 'text-gray-900' : 'text-gray-400' }}">{{ $status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="font-bold text-gray-900">Order Items</h2>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left">
                            <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50/30">
                                <tr>
                                    <th class="px-6 py-4">Product</th>
                                    <th class="px-6 py-4 text-center">Price</th>
                                    <th class="px-6 py-4 text-center">Qty</th>
                                    <th class="px-6 py-4 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="h-12 w-12 rounded-lg bg-gray-100 flex-shrink-0 flex items-center justify-center">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset($item->product->image) }}" alt="" class="h-full w-full object-cover rounded-lg">
                                                    @else
                                                        <span class="icon-[tabler--package] size-6 text-gray-400"></span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900">{{ $item->product_name }}</p>
                                                    @if(!empty($item->attributes))
                                                        <p class="text-xs text-gray-500 italic">
                                                            {{ collect($item->attributes)->map(fn($v, $k) => ucfirst($k) . ': ' . $v)->implode(', ') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-600 font-medium">
                                            {{ get_setting('currency_symbol', '$') }}{{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-600 font-medium">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-900">
                                            {{ get_setting('currency_symbol', '$') }}{{ number_format($item->price * $item->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50/30">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right text-gray-600 font-medium">Order Total</td>
                                    <td class="px-6 py-4 text-right text-2xl font-extrabold text-primary">
                                        {{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Support Card -->
                <div class="bg-gray-900 rounded-2xl p-6 text-white flex items-center justify-between gap-6">
                    <div>
                        <h3 class="text-lg font-bold mb-1">Need help with your order?</h3>
                        <p class="text-gray-400 text-sm">Our premium support team is available 24/7 to assist you.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-2.5 bg-white text-gray-900 rounded-xl font-bold hover:bg-gray-100 transition-colors whitespace-nowrap">
                        Contact Support
                    </a>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Shipping Address -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="font-bold text-gray-900">Shipping Details</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-4">
                            <span class="icon-[tabler--map-pin] size-6 text-gray-400 flex-shrink-0"></span>
                            <div>
                                <p class="font-bold text-gray-900">{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</p>
                                <p class="text-gray-600 text-sm leading-relaxed mt-1">
                                    {{ $order->shipping_address['address'] }}<br>
                                    {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['zip'] }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-gray-50">
                                    <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Contact Phone</p>
                                    <p class="text-gray-900 font-medium">{{ $order->shipping_address['phone'] ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-2 text-xs text-gray-400 uppercase font-semibold mb-1">Email Address</div>
                                <p class="text-gray-900 font-medium truncate">{{ $order->shipping_address['email'] ?? auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="font-bold text-gray-900">Payment Summary</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="icon-[tabler--credit-card] size-6 text-gray-400"></span>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-semibold">Payment Method</p>
                                <p class="text-gray-900 font-medium">{{ $order->payment_method ?? 'Credit Card' }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 pt-4 border-t border-gray-50">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="text-gray-900 font-medium">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Shipping</span>
                                <span class="text-emerald-600 font-medium font-semibold uppercase">Free</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-50 text-lg font-bold">
                                <span class="text-gray-900">Total</span>
                                <span class="text-primary">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
                            </div>
                            <div class="mt-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Payment Verified
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
