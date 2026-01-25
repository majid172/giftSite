@extends('layouts.fullscreen')

@section('content')
<div class="flex min-h-screen bg-[#F5F5F4] overflow-hidden">
    <!-- Include Aside -->
    @include('partials.aside')

    <main class="flex-1 lg:ml-80 relative flex flex-col min-h-screen">
        <!-- Include Header -->
        @include('partials.header')

        <div class="p-6 md:p-10 max-w-7xl mx-auto w-full flex-grow">
            <!-- Header -->
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-4xl font-serif font-bold text-emerald-950">Checkout</h1>
                <p class="text-stone-500 mt-2 text-lg">Finalize your order details below.</p>
            </div>
            
            <form action="{{ route('checkout.store') }}" method="POST" class="flex flex-col lg:flex-row gap-10">
                @csrf
                
                <!-- Shipping Details -->
                <div class="w-full lg:w-2/3">
                     <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 p-8">
                         <h2 class="text-2xl font-serif font-bold text-emerald-950 mb-6">Shipping Information</h2>
                         
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                 <label class="block text-sm font-medium text-stone-700 mb-1">First Name</label>
                                 <input type="text" name="first_name" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-stone-700 mb-1">Last Name</label>
                                 <input type="text" name="last_name" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                             <div class="md:col-span-2">
                                 <label class="block text-sm font-medium text-stone-700 mb-1">Email Address</label>
                                 <input type="email" name="email" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                             <div class="md:col-span-2">
                                 <label class="block text-sm font-medium text-stone-700 mb-1">Street Address</label>
                                 <input type="text" name="address" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-stone-700 mb-1">City</label>
                                 <input type="text" name="city" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-stone-700 mb-1">Postal / Zip Code</label>
                                 <input type="text" name="zip" required class="w-full rounded-lg border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                             </div>
                         </div>
                     </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 p-8 sticky top-32">
                        <h2 class="text-2xl font-serif font-bold text-emerald-950 mb-6">Your Order</h2>
                        
                        <div class="space-y-4 mb-8 max-h-60 overflow-y-auto no-scrollbar">
                             @foreach($cart as $details)
                                <div class="flex items-center gap-4">
                                     <div class="w-12 h-12 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                         <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                     </div>
                                     <div class="flex-grow">
                                         <h4 class="text-sm font-bold text-emerald-950">{{ $details['name'] }}</h4>
                                         <p class="text-xs text-stone-500">Qty: {{ $details['quantity'] }}</p>
                                     </div>
                                     <div class="text-sm font-bold text-emerald-700">
                                         ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                     </div>
                                </div>
                             @endforeach
                        </div>

                        <div class="border-t border-stone-100 pt-6 space-y-4">
                            <div class="flex justify-between text-stone-600">
                                <span>Subtotal</span>
                                <span class="font-bold">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-stone-600">
                                <span>Shipping</span>
                                <span class="font-bold text-emerald-600">Free</span>
                            </div>
                            <div class="border-t border-stone-100 pt-4 flex justify-between text-lg font-bold text-emerald-950">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="mt-8 block w-full text-center bg-emerald-900 text-white px-6 py-4 rounded-full font-bold shadow-lg hover:bg-emerald-800 transition-all hover:-translate-y-1">
                            Place Order
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Include Footer -->
        @include('partials.footer')
    </main>
</div>
@endsection
