@extends('layouts.fullscreen')
@section('content')
<div class="p-6 md:p-10 max-w-7xl mx-auto w-full flex-grow">
    <!-- Header -->
    <div class="mb-12 text-center md:text-left">
        <h1 class="text-4xl font-serif font-bold text-emerald-950">Our Collection</h1>
        <p class="text-stone-500 mt-2 text-lg">Curated gifts for every memorable moment.</p>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            // Simulated Data for "Database-less" environment
            $products = [
                ['id' => 1, 'name' => 'Grand Heritage Box', 'price' => 45.00, 'category' => 'Gift Box', 'image' => 'https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=800&q=80'],
                ['id' => 2, 'name' => 'Matte Gift Tube', 'price' => 12.00, 'category' => 'Packaging', 'image' => 'https://images.unsplash.com/photo-1544787210-22bb1c0fd310?auto=format&fit=crop&w=800&q=80'],
                ['id' => 3, 'name' => 'Monsoon Tea Tins', 'price' => 38.00, 'category' => 'Tea Set', 'image' => 'https://images.unsplash.com/photo-1563915027878-3bb14194b859?auto=format&fit=crop&w=800&q=80'],
                ['id' => 4, 'name' => 'Ceramic Tea Pot', 'price' => 28.00, 'category' => 'Homeware', 'image' => 'https://images.unsplash.com/photo-1595995574040-058df5d064dd?auto=format&fit=crop&w=800&q=80'],
                ['id' => 5, 'name' => 'Organic Honey Jar', 'price' => 18.50, 'category' => 'Pantry', 'image' => 'https://images.unsplash.com/photo-1598462740942-87002573228a?auto=format&fit=crop&w=800&q=80'],
                ['id' => 6, 'name' => 'Silk Scarves Set', 'price' => 55.00, 'category' => 'Accessories', 'image' => 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=800&q=80'],
                ['id' => 7, 'name' => 'Scented Candle', 'price' => 24.00, 'category' => 'Relaxation', 'image' => 'https://images.unsplash.com/photo-1602825266940-7060bc061eb9?auto=format&fit=crop&w=800&q=80'],
                ['id' => 8, 'name' => 'Chocolate Truffles', 'price' => 32.00, 'category' => 'Sweets', 'image' => 'https://images.unsplash.com/photo-1548907040-4baa42d10919?auto=format&fit=crop&w=800&q=80'],
            ];
        @endphp

        @foreach($products as $product)
        <div class="group">
            <div class="relative bg-white rounded-[2rem] p-4 shadow-sm group-hover:shadow-xl transition-all duration-500 ease-out border border-stone-100 h-full flex flex-col">
                <div class="rounded-[1.5rem] overflow-hidden bg-stone-50 h-64 relative mb-4">
                    <img src="{{ $product['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $product['name'] }}">
                </div>
                
                <div class="flex-grow">
                        <h3 class="font-serif font-bold text-xl text-emerald-950 group-hover:text-emerald-700 transition-colors">{{ $product['name'] }}</h3>
                        <p class="text-stone-500 text-sm mt-1 mb-3">{{ $product['category'] }}</p>
                        <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-emerald-700">${{ number_format($product['price'], 2) }}</span>
                        
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">
                            
                            <button type="submit" class="bg-amber-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-amber-600 transition-colors" title="Add to Cart">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
