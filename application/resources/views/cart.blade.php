@extends('layouts.fullscreen')

@section('title', 'Shopping Cart - Heritage Gifts')

@section('content')
<div class="bg-stone-50 min-h-screen py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-stone-500 hover:text-emerald-700 transition">Home</a></li>
                <li><svg class="w-4 h-4 text-stone-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                <li class="text-emerald-700 font-medium">Shopping Cart</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-12 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-emerald-950 mb-4">Your Shopping Cart</h1>
            <p class="text-stone-500 text-lg max-w-2xl">A curated selection of heritage gifts, prepared for your special moments.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-100 border border-emerald-400 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in" role="alert">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-medium tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($cart) && count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Cart Items List (8 Columns) -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-3xl shadow-xl shadow-stone-200/50 border border-stone-200/60 overflow-hidden transition-all duration-300">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-stone-50 border-b border-stone-100">
                                    <tr>
                                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-emerald-900/50">Item Details</th>
                                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-emerald-900/50 text-center">Quantity</th>
                                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-emerald-900/50 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @foreach($cart as $id => $details)
                                    <tr class="group hover:bg-stone-50/50 transition-colors duration-300">
                                        <td class="px-8 py-8">
                                            <div class="flex items-center gap-6">
                                                <!-- Product Image -->
                                                <div class="relative w-24 h-24 flex-shrink-0 bg-stone-100 rounded-2xl overflow-hidden border border-stone-200 group-hover:shadow-md transition-all duration-300">
                                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                                </div>
                                                
                                                <!-- Product Info -->
                                                <div class="space-y-1">
                                                    <h3 class="text-xl font-serif font-bold text-emerald-950 group-hover:text-amber-600 transition-colors">{{ $details['name'] }}</h3>
                                                    <p class="text-stone-500 text-sm font-medium">Unit Price: ${{ number_format($details['price'], 2) }}</p>
                                                    
                                                    <!-- Remove Button -->
                                                    <form action="{{ route('cart.destroy', $id) }}" method="POST" class="pt-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center gap-2 text-xs font-bold text-rose-500 hover:text-rose-600 uppercase tracking-widest transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-8">
                                            <div class="flex flex-col items-center gap-2">
                                                <div class="inline-flex items-center bg-white border-2 border-stone-200 rounded-xl px-4 py-2 font-bold text-emerald-950">
                                                    {{ $details['quantity'] }}
                                                </div>
                                                <span class="text-[10px] uppercase tracking-tighter text-stone-400 font-bold">Items</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-8 text-right">
                                            <div class="text-xl font-bold text-emerald-700">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Continue Shopping Link -->
                    <div class="pt-4">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 text-emerald-800 font-bold hover:gap-5 transition-all group">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary (4 Columns) -->
                <div class="lg:col-span-4 sticky top-8">
                    <div class="bg-emerald-950 text-white rounded-[2.5rem] p-10 shadow-2xl shadow-emerald-900/40 relative overflow-hidden border border-emerald-800">
                        <!-- Decorative Pattern -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-800/20 rounded-full blur-3xl -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl -ml-16 -mb-16"></div>

                        <h2 class="text-3xl font-serif font-bold mb-8 relative">Sum of Heritage</h2>
                        
                        <div class="space-y-6 relative border-b border-emerald-900/50 pb-8 mb-8">
                            <div class="flex justify-between items-center text-emerald-100/70">
                                <span class="text-sm uppercase tracking-widest font-medium">Subtotal</span>
                                <span class="text-lg font-bold text-white">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-emerald-100/70">
                                <div class="flex flex-col">
                                    <span class="text-sm uppercase tracking-widest font-medium">Standard Shipping</span>
                                    <span class="text-[10px] text-amber-500 font-bold mt-0.5">Complementary for heritage members</span>
                                </div>
                                <span class="text-lg font-bold text-amber-500">Free</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-end mb-10 relative">
                            <div class="flex flex-col">
                                <span class="text-amber-500 text-xs font-bold uppercase tracking-widest mb-1">Total Impact</span>
                                <h3 class="text-sm font-medium text-emerald-100/60">Final amount inclusive of taxes</h3>
                            </div>
                            <div class="text-4xl font-black text-white">
                                ${{ number_format($total, 2) }}
                            </div>
                        </div>

                        <div class="space-y-4 relative">
                            <a href="{{ route('checkout') }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-white font-black py-5 rounded-2xl shadow-lg shadow-amber-500/30 hover:shadow-xl hover:shadow-amber-600/40 transition-all transform hover:-translate-y-1 active:scale-[0.98] tracking-widest uppercase text-sm">
                                Proceed to Checkout
                            </a>
                            
                            <!-- Payment Icons -->
                            <div class="pt-6 flex justify-center gap-6 opacity-40 grayscale group hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4" alt="Visa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6" alt="Mastercard">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4" alt="PayPal">
                            </div>
                        </div>
                    </div>

                    <!-- Secure Checkout Badge -->
                    <div class="mt-6 flex items-center justify-center gap-3 text-stone-400 bg-white/50 backdrop-blur-sm rounded-2xl py-3 border border-stone-200/50">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span class="text-xs font-bold uppercase tracking-widest">End-to-End Secure Transaction</span>
                    </div>
                </div>

            </div>
        @else
            <!-- Empty Cart State -->
            <div class="max-w-2xl mx-auto text-center py-20 px-6 bg-white rounded-[3rem] shadow-2xl shadow-stone-200/50 border border-stone-100 transition-all hover:scale-[1.01] duration-500">
                <div class="w-32 h-32 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-10 shadow-inner relative overflow-hidden group">
                    <div class="absolute inset-0 bg-emerald-50 scale-0 group-hover:scale-100 transition-transform duration-700 rounded-full"></div>
                    <svg class="w-12 h-12 text-stone-300 group-hover:text-emerald-600 transition-colors duration-500 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-3xl font-serif font-bold text-emerald-950 mb-4">Your heritage collection is empty</h2>
                <p class="text-stone-500 mb-10 text-lg">It looks like you haven't selected any curated gifts yet. Start your journey through our exclusive collections.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-emerald-900 hover:bg-emerald-950 text-white px-10 py-4 rounded-full font-bold shadow-lg shadow-emerald-900/20 transition-all hover:-translate-y-1 tracking-widest uppercase text-sm">
                        Browse Collections
                    </a>
                    <a href="{{ route('home') }}" class="bg-white border-2 border-stone-200 hover:border-emerald-900 text-stone-600 hover:text-emerald-900 px-10 py-4 rounded-full font-bold transition-all hover:-translate-y-1 tracking-widest uppercase text-sm">
                        Back to Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
</style>
@endsection
