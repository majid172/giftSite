@extends('layouts.fullscreen')

@section('title', 'Shopping Cart - ' . get_setting('site_name', config('app.name')))

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
            <p class="text-stone-500 text-lg max-w-2xl">A curated selection of {{ strtolower(get_setting('site_name', config('app.name'))) }} gifts, prepared for your special moments.</p>
        </div>

        <div id="alert-container">
            @if(session('success'))
                <div class="mb-8 bg-emerald-100 border border-emerald-400 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in" role="alert">
                    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium tracking-wide">{{ session('success') }}</span>
                </div>
            @endif
        </div>

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
                                                    <p class="text-stone-500 text-sm font-medium">Unit Price: {{ get_setting('currency_symbol', '$') }}{{ number_format($details['price'], 2) }}</p>
                                                    
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
                                                <div class="flex items-center border-2 border-stone-200 rounded-xl overflow-hidden bg-white">
                                                    <button type="button" class="px-3 py-2 text-stone-500 hover:text-emerald-700 hover:bg-stone-50 transition-colors font-bold quantity-btn" data-id="{{ $id }}" data-action="decrease">-</button>
                                                    <input type="number" 
                                                           value="{{ $details['quantity'] }}" 
                                                           class="w-12 text-center border-none py-2 text-emerald-950 font-bold focus:ring-0 p-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none quantity-input" 
                                                           min="1" 
                                                           id="quantity-{{ $id }}"
                                                           data-id="{{ $id }}">
                                                    <button type="button" class="px-3 py-2 text-stone-500 hover:text-emerald-700 hover:bg-stone-50 transition-colors font-bold quantity-btn" data-id="{{ $id }}" data-action="increase">+</button>
                                                </div>
                                                <span class="text-[10px] uppercase tracking-tighter text-stone-400 font-bold">Items</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-8 py-8 text-right">
                                            <div class="text-xl font-bold text-emerald-700" id="item-subtotal-{{ $id }}">
                                                {{ get_setting('currency_symbol', '$') }}{{ number_format($details['price'] * $details['quantity'], 2) }}
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
                    <div class="bg-white rounded-3xl p-8 shadow-xl shadow-stone-200/50 border border-stone-200/60 relative overflow-hidden">
                        
                        <div class="flex items-center justify-between mb-8 pb-4 border-b border-stone-100">
                             <h2 class="text-2xl font-serif font-bold text-emerald-950">Order Summary</h2>
                             <span class="text-stone-400 text-sm">{{ count($cart) }} Items</span>
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center text-stone-600">
                                <span class="text-sm font-medium">Subtotal</span>
                                <span class="text-base font-bold text-emerald-950" id="cart-subtotal">{{ get_setting('currency_symbol', '$') }}{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-stone-600">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">Shipping Estimate</span>
                                    <span class="text-[10px] text-emerald-600 font-bold mt-0.5">Member Benefit</span>
                                </div>
                                <span class="text-base font-bold text-emerald-600">Free</span>
                            </div>
                            <div class="flex justify-between items-center text-stone-600">
                                <span class="text-sm font-medium">Tax Estimate</span>
                                <span class="text-base font-bold text-stone-400">Calculated at checkout</span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-stone-200 pt-6 mb-8">
                            <div class="flex justify-between items-end">
                                <span class="text-lg font-bold text-emerald-950">Total</span>
                                <span class="text-3xl font-serif font-bold text-emerald-800" id="cart-total">{{ get_setting('currency_symbol', '$') }}{{ number_format($total, 2) }}</span>
                            </div>
                            <p class="text-right text-xs text-stone-400 mt-2">Inclusive of all applicable taxes</p>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full text-center bg-emerald-900 hover:bg-emerald-950 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.98] transition-all duration-200 tracking-wider">
                            Proceed to Checkout
                        </a>
                        
                        <!-- Trust Badges -->
                        <div class="mt-8 grid grid-cols-3 gap-2 text-center text-[10px] text-stone-400 font-medium">
                            <div class="flex flex-col items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span>Secure Payment</span>
                            </div>
                            <div class="flex flex-col items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <span>Safe Shipping</span>
                            </div>
                            <div class="flex flex-col items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Authenticity</span>
                            </div>
                        </div>

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
                <h2 class="text-3xl font-serif font-bold text-emerald-950 mb-4">Your collection is empty</h2>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        
        function updateCart(id, quantity) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "PATCH",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id, 
                    quantity: quantity
                },
                success: function (response) {
                    if (response.success) {
                        $("#item-subtotal-" + id).text('{{ get_setting('currency_symbol', '$') }}' + response.item_subtotal);
                        $("#cart-subtotal").text('{{ get_setting('currency_symbol', '$') }}' + response.total);
                        $("#cart-total").text('{{ get_setting('currency_symbol', '$') }}' + response.total);
                        
                        // Also update the input if this came from a button click
                         $("#quantity-" + id).val(quantity);
                    } else {
                        // Revert if failed? or alert
                    }
                }
            });
        }

        $(".quantity-btn").click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var id = btn.attr("data-id");
            var action = btn.attr("data-action");
            var input = $("#quantity-" + id);
            var currentVal = parseInt(input.val());
            var newVal = currentVal;

            if (action === "increase") {
                newVal = currentVal + 1;
            } else if (action === "decrease") {
                if (currentVal > 1) {
                    newVal = currentVal - 1;
                } else {
                    return; 
                }
            }

            updateCart(id, newVal);
        });

        $(".quantity-input").change(function() {
            var input = $(this);
            var id = input.attr("data-id");
            var newVal = parseInt(input.val());

            if (newVal < 1) {
                newVal = 1;
                input.val(1);
            }

            updateCart(id, newVal);
        });
    });
</script>

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
