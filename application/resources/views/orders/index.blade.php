@extends('layouts.fullscreen')

@section('title', 'My Orders - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="py-12 min-h-screen bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-serif font-bold text-emerald-950">My Orders</h1>
            <p class="text-stone-500 mt-2 text-lg">Track and manage your comprehensive order history.</p>
        </div>

        <div class="space-y-8">
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-200 transition-all hover:shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4 border-b border-stone-100 pb-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="px-2 py-0.5 bg-stone-100 text-stone-600 rounded text-[10px] font-bold uppercase tracking-wider">Order</span>
                                <h3 class="text-xl font-bold text-emerald-950">#{{ $order->order_id }}</h3>
                            </div>
                            <p class="text-stone-500 text-xs">{{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            @php
                                $statusStyles = [
                                    'Pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'Processing' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'Completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'Canceled' => 'bg-rose-100 text-rose-700 border-rose-200',
                                    'Finalizing' => 'bg-purple-100 text-purple-700 border-purple-200',
                                ];
                                $currentStyle = $statusStyles[$order->status] ?? 'bg-stone-100 text-stone-700 border-stone-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $currentStyle }} shadow-sm">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center mb-4">
                         <!-- Items Preview -->
                         <div class="flex -space-x-3 overflow-hidden py-1 pl-1">
                            @foreach($order->items->take(6) as $item)
                                <div class="w-10 h-10 rounded-lg border-2 border-white shadow-sm bg-white overflow-hidden relative" title="{{ $item->product ? $item->product->name : $item->product_name }}">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset($item->product->image) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <div class="w-full h-full bg-stone-100 flex items-center justify-center text-stone-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @if($order->items->count() > 6)
                                <div class="w-10 h-10 rounded-lg border-2 border-white shadow-sm bg-stone-100 flex items-center justify-center text-stone-500 font-bold text-xs">
                                    +{{ $order->items->count() - 6 }}
                                </div>
                            @endif
                        </div>

                         <!-- Order Summary -->
                        <div class="flex flex-col md:items-end gap-0.5">
                            <span class="text-stone-500 text-xs font-medium uppercase tracking-wide">Total</span>
                            <span class="text-2xl font-serif font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($order->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-stone-100">
                        <a href="{{ route('orders.show', $order->id) }}" 
                           class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-emerald-700 text-white text-sm rounded-lg font-bold hover:bg-emerald-800 transition-all shadow hover:shadow-lg">
                            View Details
                        </a>
                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                           class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-white text-stone-700 text-sm border border-stone-200 rounded-lg font-bold hover:border-emerald-700 hover:text-emerald-700 transition-all shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Invoice
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl shadow-xl border border-stone-200 border-dashed">
                    <div class="w-24 h-24 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h2 class="text-2xl font-serif font-bold text-emerald-950 mb-2">No Orders Yet</h2>
                    <p class="text-stone-500 mb-8 max-w-md mx-auto">You haven't placed any orders yet. Start exploring our premium gift collection today!</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-emerald-950 text-white rounded-xl font-bold uppercase tracking-wider hover:bg-emerald-900 transition-all shadow-lg transform hover:-translate-y-0.5">
                        Start Shopping
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
