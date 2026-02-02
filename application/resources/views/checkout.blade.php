@extends('layouts.fullscreen')

@section('title', 'Secure Checkout - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="bg-stone-50 min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header / Progress -->
        <div class="mb-12 text-center">
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 mb-6">Secure Checkout</h1>
            <div class="flex items-center justify-center space-x-4 text-sm font-medium">
                <span class="flex items-center text-emerald-700">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center mr-2 text-emerald-700">✓</span>
                    Cart
                </span>
                <span class="w-12 h-px bg-stone-300"></span>
                <span class="flex items-center text-emerald-950 font-bold">
                    <span class="w-6 h-6 rounded-full bg-emerald-950 text-white flex items-center justify-center mr-2">2</span>
                    Checkout
                </span>
                <span class="w-12 h-px bg-stone-300"></span>
                <span class="flex items-center text-stone-400">
                    <span class="w-6 h-6 rounded-full border border-stone-300 flex items-center justify-center mr-2">3</span>
                    Complete
                </span>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            @csrf
            
            <!-- Main Form Section -->
            <div class="lg:col-span-7 space-y-8">
                
                <!-- Errors -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contact & Shipping -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                    <div class="px-8 py-6 border-b border-stone-100 bg-stone-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h2 class="text-xl font-serif font-bold text-emerald-950">Customer Details</h2>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-stone-500">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->name ?? '') }}" required 
                                    class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Last Name (Optional)</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" 
                                    class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Email Address (Optional)</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" 
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required 
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                        </div>

                        <div class="border-t border-stone-100 pt-6 mt-2">
                            <h3 class="text-sm font-bold text-emerald-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Shipping Address
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Street Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}" required 
                                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold uppercase tracking-widest text-stone-500">City</label>
                                        <input type="text" name="city" value="{{ old('city') }}" required 
                                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Postal Code</label>
                                        <input type="text" name="zip" value="{{ old('zip') }}" required 
                                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-stone-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden mt-8 mb-8">
                    <div class="px-8 py-6 border-b border-stone-100 bg-stone-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                        <h2 class="text-xl font-serif font-bold text-emerald-950">Shipping Method</h2>
                    </div>
                    
                    <div class="p-8 space-y-4">
                        <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-stone-50" id="label_inside_dhaka">
                            <input type="radio" name="shipping_method" value="inside_dhaka" class="w-5 h-5 text-emerald-600 border-stone-300 focus:ring-emerald-500 shipping-radio" data-cost="{{ $shippingRates['inside_dhaka'] }}" required>
                            <div class="ml-4 flex-grow">
                                <span class="block font-bold text-emerald-950">Inside Dhaka</span>
                                <span class="block text-sm text-stone-500">Standard Delivery</span>
                            </div>
                            <span class="font-bold text-emerald-700">{{ get_setting('currency_symbol', '$') }}{{ number_format($shippingRates['inside_dhaka'], 2) }}</span>
                        </label>

                        <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-stone-50" id="label_sub_inside_dhaka">
                            <input type="radio" name="shipping_method" value="sub_inside_dhaka" class="w-5 h-5 text-emerald-600 border-stone-300 focus:ring-emerald-500 shipping-radio" data-cost="{{ $shippingRates['sub_inside_dhaka'] }}">
                            <div class="ml-4 flex-grow">
                                <span class="block font-bold text-emerald-950">Dhaka Sub District</span>
                                <span class="block text-sm text-stone-500">Standard Delivery</span>
                            </div>
                             <span class="font-bold text-emerald-700">{{ get_setting('currency_symbol', '$') }}{{ number_format($shippingRates['sub_inside_dhaka'], 2) }}</span>
                        </label>

                        <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-stone-50" id="label_outside_dhaka">
                            <input type="radio" name="shipping_method" value="outside_dhaka" class="w-5 h-5 text-emerald-600 border-stone-300 focus:ring-emerald-500 shipping-radio" data-cost="{{ $shippingRates['outside_dhaka'] }}">
                            <div class="ml-4 flex-grow">
                                <span class="block font-bold text-emerald-950">Outside Dhaka</span>
                                <span class="block text-sm text-stone-500">Standard Delivery</span>
                            </div>
                             <span class="font-bold text-emerald-700">{{ get_setting('currency_symbol', '$') }}{{ number_format($shippingRates['outside_dhaka'], 2) }}</span>
                        </label>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                    <div class="px-8 py-6 border-b border-stone-100 bg-stone-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h2 class="text-xl font-serif font-bold text-emerald-950">Payment Method</h2>
                    </div>
                    
                    <div class="p-8">
                        <label class="relative flex items-center p-6 border-2 border-emerald-500 bg-emerald-50/30 rounded-xl cursor-pointer transition-all hover:bg-emerald-50">
                            <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-emerald-600 border-stone-300 focus:ring-emerald-500">
                            <div class="ml-4 flex-grow">
                                <span class="block text-lg font-bold text-emerald-950">Cash on Delivery</span>
                                <span class="block text-sm text-stone-500 mt-1">Pay securely upon receiving your items</span>
                            </div>
                            <svg class="w-8 h-8 text-emerald-600 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-5 sticky top-8">
                <div class="bg-white rounded-2xl shadow-xl shadow-stone-200/60 border border-stone-200 overflow-hidden">
                    <div class="bg-white px-8 py-6 border-b border-stone-100">
                        <h2 class="text-xl font-serif font-bold text-emerald-950">Order Summary</h2>
                        <p class="text-stone-400 text-sm mt-1">Order #PENDING-{{ rand(1000,9999) }}</p>
                    </div>

                    <!-- Items -->
                    <div class="max-h-96 overflow-y-auto px-8 py-2 divide-y divide-stone-100">
                        @foreach($cart as $details)
                        <div class="py-6 flex gap-4">
                            <div class="w-20 h-20 rounded-lg bg-stone-100 overflow-hidden flex-shrink-0 border border-stone-200">
                                <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow min-w-0">
                                <h4 class="font-bold text-emerald-900 line-clamp-2 leading-snug">{{ $details['name'] }}</h4>
                                <div class="flex justify-between items-end mt-2">
                                    <p class="text-sm text-stone-500">Qty: {{ $details['quantity'] }}</p>
                                    <p class="font-bold text-emerald-700 font-serif">{{ get_setting('currency_symbol', '$') }}{{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="p-8 bg-stone-50 border-t border-stone-100 space-y-4">
                        <div class="flex justify-between items-center text-sm text-stone-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-stone-600">
                            <span>Shipping</span>
                            <div id="shippingDisplay">
                                @if($shippingCost > 0)
                                    <span class="font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($shippingCost, 2) }}</span>
                                @else
                                    <span class="font-bold text-stone-400">Select Method</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="pt-4 mt-4 border-t border-stone-200 flex justify-between items-end">
                            <span class="text-lg font-bold text-emerald-950 font-serif">Total</span>
                            <span class="text-3xl font-bold text-emerald-800 font-serif mb-1" id="totalDisplay">{{ get_setting('currency_symbol', '$') }}{{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-600/30 transition-all transform hover:-translate-y-0.5 active:scale-[0.99] mt-6 flex items-center justify-center gap-2 group">
                            <span>Complete Order</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        
                        <div class="flex items-center justify-center gap-2 text-xs text-stone-400 mt-4">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span>Encrypted & Secured Transaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shippingRadios = document.querySelectorAll('.shipping-radio');
        const shippingDisplay = document.getElementById('shippingDisplay');
        const totalDisplay = document.getElementById('totalDisplay');
        const subtotal = {{ $subtotal }};
        const currencySymbol = "{{ get_setting('currency_symbol', '$') }}";

        function updateTotals() {
            let shippingCost = 0;
            const selectedRadio = document.querySelector('input[name="shipping_method"]:checked');
            
            if (selectedRadio) {
                shippingCost = parseFloat(selectedRadio.dataset.cost);
                
                // Highlight selected label
                document.querySelectorAll('label[id^="label_"]').forEach(l => l.classList.remove('border-emerald-500', 'bg-emerald-50/30'));
                selectedRadio.closest('label').classList.add('border-emerald-500', 'bg-emerald-50/30');
            }

            // Update Shipping Display
            if(shippingCost > 0) {
                 shippingDisplay.innerHTML = `<span class="font-bold text-emerald-950">${currencySymbol}${shippingCost.toFixed(2)}</span>`;
            } else {
                 shippingDisplay.innerHTML = `<span class="font-bold text-stone-400">Select Method</span>`;
            }

            // Update Total Display
            const total = subtotal + shippingCost;
            totalDisplay.innerText = currencySymbol + total.toFixed(2);
        }

        shippingRadios.forEach(radio => {
            radio.addEventListener('change', updateTotals);
        });

        // Initialize (if old input exists or just to reset)
        updateTotals();
    });
</script>
@endpush
