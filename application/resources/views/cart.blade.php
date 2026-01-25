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
                <h1 class="text-4xl font-serif font-bold text-emerald-950">Shopping Cart</h1>
                <p class="text-stone-500 mt-2 text-lg">Review your curated selections.</p>
            </div>
            
            @if(session('success'))
                <div class="mb-8 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(isset($cart) && count($cart) > 0)
                <div class="flex flex-col lg:flex-row gap-10">
                    <!-- Cart Items -->
                    <div class="w-full lg:w-2/3">
                         <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 overflow-hidden">
                             <div class="overflow-x-auto">
                                 <table class="w-full text-left">
                                     <thead class="bg-stone-50 text-stone-500 text-xs uppercase tracking-wider">
                                         <tr>
                                             <th class="px-6 py-4 font-semibold">Product</th>
                                             <th class="px-6 py-4 font-semibold">Price</th>
                                             <th class="px-6 py-4 font-semibold">Quantity</th>
                                             <th class="px-6 py-4 font-semibold">Total</th>
                                             <th class="px-6 py-4 font-semibold">Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody class="divide-y divide-stone-100">
                                        @foreach($cart as $id => $details)
                                         <tr class="group hover:bg-stone-50/50 transition-colors">
                                             <td class="px-6 py-4">
                                                 <div class="flex items-center gap-4">
                                                     <div class="w-16 h-16 rounded-xl overflow-hidden bg-stone-100 flex-shrink-0">
                                                         <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                                     </div>
                                                     <div>
                                                         <h3 class="font-serif font-bold text-emerald-950">{{ $details['name'] }}</h3>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="px-6 py-4 text-stone-600 font-medium">${{ number_format($details['price'], 2) }}</td>
                                             <td class="px-6 py-4 text-stone-600">
                                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-stone-100 text-sm font-bold">
                                                    {{ $details['quantity'] }}
                                                </div>
                                             </td>
                                             <td class="px-6 py-4 text-emerald-700 font-bold">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                             <td class="px-6 py-4">
                                                <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-stone-400 hover:text-rose-500 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                             </td>
                                         </tr>
                                        @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                    </div>

                    <!-- Summary -->
                    <div class="w-full lg:w-1/3">
                        <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 p-8 sticky top-32">
                            <h2 class="text-2xl font-serif font-bold text-emerald-950 mb-6">Order Summary</h2>
                            <div class="space-y-4 mb-8">
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
                            <a href="{{ route('checkout') }}" class="block w-full text-center bg-amber-500 text-white px-6 py-4 rounded-full font-bold shadow-lg hover:bg-amber-600 transition-all hover:-translate-y-1">
                                Proceed to Checkout
                            </a>
                             <a href="{{ route('products.index') }}" class="block w-full text-center mt-4 text-stone-500 hover:text-emerald-700 font-medium transition-colors text-sm">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 p-12 text-center max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-serif font-bold text-emerald-950 mb-2">Your cart is empty</h2>
                    <p class="text-stone-500 mb-8">Looks like you haven't added any premium gifts yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-emerald-900 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-emerald-800 transition-all">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- Include Footer -->
        @include('partials.footer')
    </main>
</div>
@endsection
