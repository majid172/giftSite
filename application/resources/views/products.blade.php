@extends('layouts.fullscreen')
@section('content')
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-serif font-bold text-emerald-950">Our Collection</h1>
        <p class="text-stone-500 mt-2 text-lg">Curated gifts for every memorable moment.</p>
    </div>

    <!-- Products Grid -->
    <!-- Products Grid -->
    @if($products->isNotEmpty())
    <div class="border border-stone-200 rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-stone-200 bg-white">
            @foreach($products as $product)
            <div class="group relative p-6 hover:shadow-2xl transition-shadow duration-300 z-0 hover:z-10 bg-white">
                
                <!-- Badges -->
                <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">
                    @if($product->badge)
                        <span class="{{ $product->badge_color ?? 'bg-amber-500' }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wide">{{ $product->badge }}</span>
                    @endif
                </div>

                <!-- Hover Actions -->
                <div class="absolute top-4 right-4 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                    <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Compare">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Quick View">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>

                <!-- Image -->
                <div class="h-48 mb-4 overflow-hidden relative flex items-center justify-center">
                    <img src="{{ asset($product->image) }}" class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500" alt="{{ $product->name }}">
                </div>

                <!-- Content -->
                <div class="text-left">
                    <h3 class="font-bold text-emerald-950 text-sm mb-2 h-10 overflow-hidden line-clamp-2 leading-tight">
                        <a href="{{ route('product.show', $product->id) }}" class="hover:text-amber-500 transition">{{ $product->name }}</a>
                    </h3>
                    
                    <!-- Ratings -->
                    <!-- Ratings -->
                    <div class="flex items-center gap-0.5 mb-2">
                        @php
                            $avgRating = $product->reviews->avg('rating') ?: 0;
                            $reviewsCount = $product->reviews->count();
                        @endphp
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                        <span class="text-xs text-stone-400 ml-1">({{ $reviewsCount }})</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-5 flex items-baseline gap-2">
                        <span class="text-lg font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span class="text-sm text-stone-400 line-through decoration-stone-400 decoration-1">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Add to Cart Button -->
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <button type="submit" class="w-full bg-stone-100 hover:bg-amber-400 text-stone-800 hover:text-white font-bold text-xs uppercase tracking-wider py-3 rounded-full transition-all duration-300 shadow-sm hover:shadow-md">
                            Add To Cart
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="py-20 text-center border border-dashed border-stone-200 rounded-lg bg-stone-50">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full mb-6 shadow-sm">
            <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12H4M4 12L12 4M4 12L12 20"></path>
                <!-- Changing icon to Package Off similar to Tabler -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3zm0 9l8-4.5M12 12v9m0-9L4 7.5m16 0l-5 2.8"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18"/>
            </svg>
        </div>
        <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-2">No Products Found</h3>
        <p class="text-stone-500 mb-8 max-w-md mx-auto text-lg">We couldn't find any products in our collection at the moment. Please check back soon!</p>
        <a href="{{ route('home') }}" class="inline-block bg-emerald-950 text-white px-8 py-3 rounded-full font-bold uppercase tracking-wider hover:bg-emerald-900 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            Back to Home
        </a>
    </div>
    @endif
</div>
@endsection
