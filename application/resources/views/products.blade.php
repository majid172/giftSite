@extends('layouts.fullscreen')
@section('content')
    <div class="py-8">
        <!-- Collection Header & Filters -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 mt-5 md:mt-0 px-2 md:px-0">
            <div>
                <h1 class="text-3xl md:text-5xl font-serif font-bold text-emerald-950 tracking-tight">Our Collection</h1>
                <p class="text-stone-500 mt-2 text-sm md:text-lg max-w-xl leading-relaxed">Discover our handpicked selection of premium gifts, curated for life's most special moments.</p>
            </div>
            
            <!-- Sorting Controls -->
            <div class="flex items-center gap-2 bg-stone-100 p-1 rounded-xl w-full md:w-fit overflow-x-auto whitespace-nowrap scrollbar-hide">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" 
                   class="flex-1 md:flex-none text-center px-4 py-2.5 rounded-lg text-[10px] md:text-[11px] font-bold uppercase tracking-widest transition-all duration-300 {{ request('sort') == 'price_asc' ? 'bg-emerald-950 text-white shadow-lg' : 'text-stone-500 hover:text-emerald-950 hover:bg-white' }}">
                   Price: Low to High
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" 
                   class="flex-1 md:flex-none text-center px-4 py-2.5 rounded-lg text-[10px] md:text-[11px] font-bold uppercase tracking-widest transition-all duration-300 {{ request('sort') == 'price_desc' ? 'bg-emerald-950 text-white shadow-lg' : 'text-stone-500 hover:text-emerald-950 hover:bg-white' }}">
                   Price: High to Low
                </a>
                @if(request('sort'))
                <a href="{{ request()->url() }}" 
                   class="px-3 py-2.5 text-stone-400 hover:text-rose-500 transition-colors" title="Clear Sort">
                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18"></path></svg>
                </a>
                @endif
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach($products as $product)
                    <div
                        class="bg-white rounded-md border border-stone-200 overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col h-full group p-3 sm:p-5 relative">

                        <!-- Badges -->
                        <div class="absolute top-2 left-2 sm:top-4 sm:left-4 z-20 flex flex-col gap-1.5 sm:gap-2">
                            @if($product->badge)
                                <span
                                    class="{{ $product->badge_color ?? 'bg-amber-500' }} text-white text-[9px] sm:text-[10px] font-bold px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-sm uppercase tracking-wide">{{ $product->badge }}</span>
                            @endif
                        </div>

                        <!-- Hover Actions -->
                        <!--<div class="absolute top-4 right-4 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">-->

                        <!--    <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Compare">-->
                        <!--        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>-->
                        <!--    </button>-->
                        <!--    <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Quick View">-->
                        <!--        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>-->
                        <!--    </button>-->
                        <!--</div>-->

                        <!-- Image -->
                        <div
                            class="aspect-[4/3] w-full mb-3 sm:mb-4 overflow-hidden relative flex items-center justify-center bg-stone-50 rounded-lg">
                            <img src="{{ asset($product->image) }}"
                                class="w-full h-full object-contain p-2 sm:p-3 transform group-hover:scale-110 transition-transform duration-500"
                                alt="{{ $product->name }}">
                        </div>

                        <!-- Content -->
                        <div class="text-left flex flex-col flex-1">
                            <h3
                                class="font-bold text-emerald-950 text-[13px] sm:text-sm mb-1.5 sm:mb-2 h-9 sm:h-10 overflow-hidden line-clamp-2 leading-tight">
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="hover:text-amber-500 transition">{{ $product->name }}</a>
                            </h3>

                            <!-- Ratings -->
                            <!-- Ratings -->
                            <div class="flex items-center gap-0.5 mb-1.5 sm:mb-2">
                                @php
                                    $avgRating = $product->reviews->avg('rating') ?: 0;
                                    $reviewsCount = $product->reviews->count();
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="text-[10px] sm:text-xs text-stone-400 ml-1">({{ $reviewsCount }})</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-3 sm:mb-5 flex items-baseline gap-1.5 sm:gap-2">
                                <span
                                    class="text-[15px] sm:text-lg font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->price, 2) }}</span>
                                @if($product->old_price)
                                    <span
                                        class="text-[11px] sm:text-sm text-stone-400 line-through decoration-stone-400 decoration-1">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->old_price, 2) }}</span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="mt-auto pt-3 sm:pt-4 border-t border-stone-100 flex-1 flex flex-col justify-end">
                                <form action="{{ route('cart.store') }}" method="POST"
                                    class="flex flex-col xl:flex-row gap-1.5 sm:gap-2 w-full">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="image" value="{{ $product->image }}">

                                    <button type="submit" name="action" value="add_to_cart"
                                        class="flex-1 border border-emerald-950 text-emerald-950 hover:bg-emerald-950 hover:text-white text-[9px] sm:text-[11px] font-bold uppercase tracking-widest py-2 sm:py-2.5 transition-colors whitespace-nowrap">
                                        Add
                                    </button>
                                    <button type="submit" name="action" value="buy_now"
                                        class="flex-1 bg-amber-500 hover:bg-amber-600 text-white text-[9px] sm:text-[11px] font-bold uppercase tracking-widest py-2 sm:py-2.5 transition-colors whitespace-nowrap">
                                        Order
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="py-20 text-center border border-dashed border-stone-200 rounded-lg bg-stone-50">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full mb-6 shadow-sm">
                    <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 12H4M4 12L12 4M4 12L12 20"></path>
                        <!-- Changing icon to Package Off similar to Tabler -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3zm0 9l8-4.5M12 12v9m0-9L4 7.5m16 0l-5 2.8" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18" />
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-2">No Products Found</h3>
                <p class="text-stone-500 mb-8 max-w-md mx-auto text-lg">We couldn't find any products in our collection at the
                    moment. Please check back soon!</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-emerald-950 text-white px-8 py-3 rounded-full font-bold uppercase tracking-wider hover:bg-emerald-900 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Back to Home
                </a>
            </div>
        @endif
    </div>
@endsection