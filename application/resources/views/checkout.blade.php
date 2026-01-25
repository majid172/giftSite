@extends('layouts.fullscreen')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-stone-50 to-stone-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-4">
                    <!-- Step 1: Cart -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-600 text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                        </div>
                        <span class="ml-2 text-sm font-medium text-emerald-600 hidden sm:block">Cart</span>
                    </div>
                    <div class="w-16 h-0.5 bg-emerald-600"></div>
                    
                    <!-- Step 2: Checkout (Active) -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-amber-500 text-white shadow-lg shadow-amber-500/50 ring-4 ring-amber-100">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="ml-2 text-sm font-bold text-amber-500 hidden sm:block">Checkout</span>
                    </div>
                    <div class="w-16 h-0.5 bg-stone-300"></div>
                    
                    <!-- Step 3: Complete -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-stone-300 text-stone-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="ml-2 text-sm font-medium text-stone-400 hidden sm:block">Complete</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            
            <!-- Left Column: Forms (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Contact Information Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Contact Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-stone-700 mb-2">First Name *</label>
                                <input type="text" name="first_name" required 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                    placeholder="John">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-stone-700 mb-2">Last Name *</label>
                                <input type="text" name="last_name" required 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                    placeholder="Doe">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-stone-700 mb-2">Email Address *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="email" name="email" required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                        placeholder="john.doe@example.com">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Shipping Address</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-stone-700 mb-2">Street Address *</label>
                                <input type="text" name="address" required 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                    placeholder="123 Main Street, Apt 4B">
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-stone-700 mb-2">City *</label>
                                    <input type="text" name="city" required 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                        placeholder="New York">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-stone-700 mb-2">Postal Code *</label>
                                    <input type="text" name="zip" required 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all outline-none"
                                        placeholder="10001">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Payment Method</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center p-8 bg-stone-50 rounded-xl border-2 border-dashed border-stone-300">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto text-stone-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-stone-600 font-medium">Cash on Delivery</p>
                                <p class="text-sm text-stone-500 mt-1">Pay when you receive your order</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary (1/3 width) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-stone-200 overflow-hidden sticky top-24">
                    <!-- Header -->
                    <div class="bg-gradient-to-br from-emerald-900 to-emerald-800 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Order Summary
                        </h2>
                    </div>

                    <!-- Products List -->
                    <div class="p-6 max-h-80 overflow-y-auto">
                        <div class="space-y-4">
                            @foreach($cart as $details)
                            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-stone-50 transition-colors">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0 shadow-sm">
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="text-sm font-bold text-emerald-950 truncate">{{ $details['name'] }}</h4>
                                    <p class="text-xs text-stone-500 mt-1">Qty: <span class="font-semibold">{{ $details['quantity'] }}</span></p>
                                </div>
                                <div class="text-sm font-bold text-emerald-700 flex-shrink-0">
                                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="px-6 pb-6">
                        <div class="border-t-2 border-stone-100 pt-5 space-y-3">
                            <div class="flex justify-between text-stone-600">
                                <span class="font-medium">Subtotal</span>
                                <span class="font-bold">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-stone-600">
                                <span class="font-medium">Shipping</span>
                                <span class="font-bold text-emerald-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Free
                                </span>
                            </div>
                            <div class="border-t-2 border-stone-100 pt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-emerald-950">Total</span>
                                <span class="text-2xl font-black text-emerald-700">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="mt-6 w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-amber-500/50 hover:shadow-xl hover:shadow-amber-600/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Place Order Now
                        </button>

                        <!-- Security Badge -->
                        <div class="mt-4 flex items-center justify-center text-xs text-stone-500">
                            <svg class="w-4 h-4 mr-1 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Secure Checkout
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
