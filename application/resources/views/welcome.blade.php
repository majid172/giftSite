@extends('layouts.fullscreen')

@section('content')

@section('hero')
    <section class="relative w-full bg-emerald-950 overflow-hidden font-sans min-h-[85vh] flex items-center pt-20">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-emerald-900/30"></div>
        <div class="absolute top-0 right-0 w-[60%] h-full bg-emerald-800/40 clip-diagonal"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full h-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center h-full">

                <!-- Left Content -->
                <div class="flex flex-col justify-center order-2 lg:order-1 lg:pr-10">
                    
                    <div class="inline-flex items-center gap-4 mb-6">
                        <span class="flex h-px w-12 bg-amber-500"></span>
                        <span class="text-amber-400 font-medium tracking-widest text-xs uppercase">Premium Gifting</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-[4rem] font-serif font-bold text-white leading-tight mb-6">
                        The Art of <br>
                        <span class="text-amber-300 italic">Thoughtful</span> Giving
                    </h1>

                    <p class="text-emerald-50/90 text-lg md:text-xl mb-10 max-w-lg leading-relaxed font-light">
                        Discover exclusive, beautifully curated collections that turn ordinary moments into unforgettable memories. Experience the joy of giving.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-10">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-amber-500 text-emerald-950 font-bold text-base rounded shadow-lg hover:bg-amber-400 transition-colors">
                            Shop Collection
                        </a>
                        
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-white/5 border border-white/20 text-white font-semibold rounded hover:bg-white/10 transition-colors">
                            Our Story
                        </a>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="order-1 lg:order-2 relative w-full h-[400px] lg:h-[600px] flex items-center justify-center">
                    
                    <!-- Decorative background behind image -->
                    <div class="absolute inset-y-10 inset-x-0 bg-emerald-900/50 rounded-[3rem] -rotate-3 border border-emerald-800/50"></div>

                    <div class="relative w-[85%] h-[90%] z-10 rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        <img src="{{ get_setting('hero_image') ? asset(get_setting('hero_image')) : 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1920&q=80' }}"
                            class="w-full h-full object-cover object-center" alt="{{ get_setting('site_name', config('app.name')) }} Packaging">
                        <div class="absolute inset-0 bg-emerald-900/10 mix-blend-multiply"></div>
                    </div>

                    <!-- Floating Badge (Static) -->
                    <div class="absolute bottom-10 left-0 bg-white p-4 rounded-xl shadow-xl flex items-center gap-4 z-20">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <div>
                            <p class="text-emerald-950 font-bold leading-tight">{{ $averageRating ?? 5.0 }}/5</p>
                            <p class="text-stone-500 text-xs">{{ get_setting('hero_customer_text', 'Customer Reviews') }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        
        <style>
            .clip-diagonal {
                clip-path: polygon(10% 0, 100% 0, 100% 100%, 0 100%);
            }
        </style>
    </section>
@endsection

@section('content')
    <section>
        <div class="space-y-16">

            <!-- 1. Shop By Category (App Icon Style) -->
            <section>
                <div class="flex items-center justify-between mb-6 md:mb-8">
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-emerald-950">Shop by Category</h2>
                    <a href="{{ route('categories.index') }}"
                        class="text-emerald-700 font-bold text-sm hover:text-emerald-900 transition flex items-center gap-1 group">
                        View all <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <style>
                    .hide-scrollbar::-webkit-scrollbar {
                        display: none;
                    }
                    .hide-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                </style>

                <div class="flex overflow-x-auto hide-scrollbar gap-4 sm:gap-6 pb-4 md:grid md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 md:overflow-visible">
                    @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="flex flex-col items-center gap-2 sm:gap-3 flex-shrink-0 group w-[76px] sm:w-[90px] md:w-auto md:flex-shrink">
                        <div class="w-[76px] h-[76px] md:w-full md:aspect-square sm:w-[90px] sm:h-[90px] bg-white rounded-[1.25rem] sm:rounded-[1.5rem] shadow-[0_2px_10px_rgba(0,0,0,0.06)] border border-stone-100 flex items-center justify-center overflow-hidden group-hover:shadow-[0_8px_20px_rgba(0,0,0,0.12)] group-hover:-translate-y-1 transition-all duration-300">
                            <img src="{{ asset('assets/images/'.$category->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                alt="{{ $category->name }}">
                        </div>
                        <span class="text-[11px] sm:text-[13px] font-medium text-emerald-950 text-center w-full leading-tight group-hover:text-amber-500 transition-colors px-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; white-space: normal;">{{ $category->name }}</span>
                    </a>
                    @endforeach
                </div>
            </section>

            <!-- Bestselling Products Section -->
            <!-- Section Header -->
            <div class="mb-10">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 text-center lg:text-left">Bestselling
                    Products</h2>
            </div>

            <!-- Main Grid Container: items-stretch ensures equal height for both columns -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                <!-- Left Featured Card: Premium "Deal of the Month" Design -->
                <div class="lg:col-span-4 flex">
                    <div
                        class="relative w-full bg-emerald-950 rounded-2xl overflow-hidden shadow-2xl flex flex-col justify-between group">

                        <!-- Background Gradient & Effects -->
                        <div
                            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-emerald-800/40 via-emerald-950 to-emerald-950">
                        </div>
                        <div
                            class="absolute -top-24 -right-24 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl pointer-events-none">
                        </div>

                        <!-- Content Container -->
                        <div class="relative z-10 p-8 flex flex-col h-full">

                            <!-- Header -->
                            <div class="flex justify-between items-start mb-4">
                                <span
                                    class="inline-block px-3 py-1 rounded-full border border-amber-500/30 bg-amber-500/10 text-amber-400 text-[10px] font-bold tracking-widest uppercase backdrop-blur-sm">
                                    Deal of the Month
                                </span>
                            </div>

                            <!-- Title -->
                            <div class="mb-4 align-middle">
                                <h3 class="text-3xl lg:text-4xl font-serif font-bold text-white leading-tight align-middle">
                                    {{ get_setting('site_name', config('app.name')) }} Grand <br> <span class="text-emerald-400 italic">Edition Box</span>
                                </h3>
                                <p class="text-emerald-200/60 text-sm mt-2 max-w-[80%]">Curated luxury for the ultimate
                                    gifting
                                    experience.</p>
                            </div>



                            <!-- Footer: Price & CTA -->
                            <div class="mt-auto pt-6 border-t border-emerald-800/50">


                                <button
                                    class="w-full bg-white text-emerald-950 font-bold py-4 rounded-xl hover:bg-amber-400 hover:text-white transition-all duration-300 shadow-lg hover:shadow-amber-500/20 flex items-center justify-center gap-2 group-hover:gap-3">
                                    Shop Exclusive Deal
                                    <svg class="w-4 h-4 transition-all" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Product Grid -->
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 h-full">
                        @foreach ($bestSellingProducts as $product)
                            <div class="bg-white border border-stone-200 rounded-xl sm:rounded-2xl p-2.5 sm:p-5 hover:shadow-2xl transition-all duration-300 group flex flex-col">

                                <!-- Product Image Container -->
                                <div class="relative w-full aspect-[4/3] sm:h-48 mb-3 sm:mb-6 flex items-center justify-center overflow-hidden">
                                     @if ($product->old_price)
                                        <div class="absolute top-0 left-0 z-10">
                                            <span class="bg-rose-500 text-white text-[9px] sm:text-[10px] font-bold px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-sm uppercase">{{ calculate_discount($product->price, $product->old_price) }}% OFF</span>
                                        </div>
                                    @endif

                                    <img src="{{ asset($product->image) }}"
                                        class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500"
                                        alt="{{ $product->name }}">
                                </div>

                                <!-- Product Info -->
                                <div class="flex flex-col flex-grow text-left">
                                    <h4 class="text-[13px] sm:text-sm font-serif font-bold text-emerald-950 mb-1.5 sm:mb-3 leading-snug line-clamp-2 h-10 overflow-hidden">
                                        <a href="{{ route('product.show', $product->id) }}" class="hover:text-amber-500 transition">{{ $product->name }}</a>
                                    </h4>

                                    <!-- Star Rating (Dynamic) -->
                                    <div class="flex items-center gap-0.5 mb-1.5 sm:mb-3">
                                        @php
                                            $avgRating = $product->reviews_avg_rating ?: 0;
                                            $reviewsCount = $product->reviews_count ?: 0;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 sm:w-3.5 h-3 sm:h-3.5 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="text-[10px] sm:text-xs text-stone-400 ml-1">({{ $reviewsCount }})</span>
                                    </div>

                                    <!-- Price -->
                                    <div class="flex items-baseline gap-2 mb-3 sm:mb-5">
                                        <span class="text-[15px] sm:text-xl font-bold text-emerald-950 tracking-tight">{{ get_setting('currency_symbol', 'BDT') }}{{ number_format($product->price, 2) }}</span>
                                        @if ($product->old_price)
                                            <span class="text-[11px] sm:text-xs text-stone-400 line-through">{{ get_setting('currency_symbol', 'BDT') }}{{ number_format($product->old_price, 2) }}</span>
                                        @endif
                                    </div>

                                    <!-- Add to cart & Order Now Actions -->
                                    <form action="{{ route('cart.store') }}" method="POST" class="mt-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-stone-100 flex flex-col xl:flex-row gap-1.5 sm:gap-2 w-full">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="image" value="{{ $product->image }}">
                                        
                                        <button type="submit" name="action" value="add_to_cart" class="flex-1 border border-emerald-950 text-emerald-950 hover:bg-emerald-950 hover:text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-widest py-2 sm:py-2.5 transition-colors whitespace-nowrap">
                                            Add
                                        </button>
                                        <button type="submit" name="action" value="buy_now" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-widest py-2 sm:py-2.5 transition-colors whitespace-nowrap">
                                            Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Latest Products (Minimalist Professional) -->
    <section class="max-w-7xl mx-auto my-20 px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-left">
            <h2 class="text-3xl md:text-4xl font-serif text-emerald-950 mb-3">Latest Arrivals</h2>
            <div class="h-[2px] w-12 bg-amber-500"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-x-6 sm:gap-y-10">
            @foreach ($latestProds as $item)
                <div class="group flex flex-col relative w-full">
                    
                    <!-- Image Area -->
                    <div class="relative w-full aspect-[4/3] bg-stone-50/80 flex items-center justify-center overflow-hidden mb-2 rounded-sm hover:-translate-y-1 transition-transform duration-300">
                        <!-- Badge -->
                        @if ($item->badge)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="bg-emerald-950 text-white text-[9px] px-2 py-1 uppercase tracking-widest">{{ $item->badge }}</span>
                            </div>
                        @elseif($item->old_price)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="bg-amber-500 text-white text-[9px] px-2 py-1 uppercase tracking-widest">Sale</span>
                            </div>
                        @endif

                        <!-- Image -->
                        <img src="{{ asset($item->image) }}" class="w-[85%] h-[85%] object-contain mix-blend-multiply opacity-90 group-hover:opacity-100 transition-opacity duration-300" alt="{{ $item->name }}">

                    </div>

                    <!-- Content Area (Left Aligned matching image) -->
                    <div class="flex flex-col items-start text-left px-1 flex-1">
                        <!-- Title -->
                        <h3 class="text-[14px] md:text-[15px] font-serif font-bold text-emerald-950 mb-1.5 leading-snug line-clamp-2 min-h-[40px]">
                            <a href="{{ route('product.show', $item->id) }}" class="hover:text-amber-500 transition-colors">{{ $item->name }}</a>
                        </h3>
                        
                        <!-- Ratings -->
                        <div class="flex items-center gap-1 mb-1.5">
                            @php
                                $avgRating = $item->reviews_avg_rating ?: 0;
                            @endphp
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-[11px] text-stone-400 font-medium">({{ $item->reviews_count ?: 0 }})</span>
                        </div>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-3 w-full">
                            <span class="text-emerald-950 text-[17px] md:text-lg font-extrabold tracking-tight">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price, 2) }}</span>
                            @if ($item->old_price)
                                <span class="text-[13px] text-stone-400 line-through">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->old_price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Add to cart & Order Now Actions (Always Visible) -->
                        <div class="w-full mt-auto pt-4 border-t border-stone-100">
                            <form action="{{ route('cart.store') }}" method="POST" class="flex flex-col xl:flex-row gap-2 w-full">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="name" value="{{ $item->name }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                                <input type="hidden" name="image" value="{{ $item->image }}">
                                
                                <button type="submit" name="action" value="add_to_cart" class="flex-1 border border-emerald-950 text-emerald-950 hover:bg-emerald-950 hover:text-white text-[10px] font-bold uppercase tracking-widest py-2.5 transition-colors whitespace-nowrap">
                                    Add Cart
                                </button>
                                <button type="submit" name="action" value="buy_now" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-bold uppercase tracking-widest py-2.5 transition-colors whitespace-nowrap">
                                    Order Now
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        
        <div class="mt-14 text-center">
            <a href="{{ route('products.index') }}" class="inline-block border border-emerald-950 text-emerald-950 hover:bg-emerald-950 hover:text-white px-10 py-3.5 text-xs font-bold uppercase tracking-widest transition-colors duration-300">
                View All Arrivals
            </a>
        </div>
    </section>

    @if($featuredProducts->count() > 0)
    <section class="py-16">
        <!-- Header Section -->
        <div class="mb-8 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 uppercase tracking-tight">Featured
                Products</h2>
            <div class="h-1 w-20 bg-emerald-900 mt-2 mx-auto md:mx-0"></div>
        </div>

        <!-- Product Grid: Using thin borders to create the cell look from the image -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-stone-200 bg-white shadow-sm">
            @foreach ($featuredProducts as $product)
                <div class="relative border-r border-b border-stone-200 p-6 flex items-center gap-6 group hover:bg-stone-50 transition-colors duration-300">

                    @if ($product->badge)
                        <div class="absolute top-4 left-4 z-10">
                            <span class="{{ $product->badge_color ?? 'bg-emerald-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ $product->badge }}</span>
                        </div>
                    @elseif($product->old_price)
                         <div class="absolute top-4 left-4 z-10">
                            <span class="bg-rose-500 text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ calculate_discount($product->price, $product->old_price) }}% OFF</span>
                        </div>
                    @endif

                    <!-- Left Side: Image -->
                    <div class="w-1/3 flex-shrink-0 overflow-hidden">
                        <img src="{{ asset($product->image) }}"
                            class="w-full h-28 object-contain transform group-hover:scale-110 transition-transform duration-500"
                            alt="{{ $product->name }}">
                    </div>

                    <!-- Right Side: Details -->
                    <div class="w-2/3">
                        <h3 class="text-sm font-bold text-emerald-950 leading-tight mb-2 h-10 overflow-hidden line-clamp-2">
                             <a href="{{ route('product.show', $product->id) }}" class="hover:text-amber-500 transition">{{ $product->name }}</a>
                        </h3>

                        <!-- Rating -->
                        <div class="flex items-center gap-0.5 mb-2">
                            @php
                                $avgRating = $product->reviews_avg_rating ?: 0;
                                $reviewsCount = $product->reviews_count ?: 0;
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-3 h-3 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="text-[10px] text-stone-400 ml-1">({{ $reviewsCount }})</span>
                        </div>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-base font-black text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->price, 2) }}</span>
                            @if ($product->old_price)
                                <span class="text-[11px] text-stone-400 line-through">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->old_price, 2) }}</span>
                            @endif
                        </div>

                         <!-- Add to Cart Button -->
                        <form action="{{ route('cart.store') }}" method="POST" class="flex gap-2 mt-2">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                            
                            <button type="submit" name="action" value="add_to_cart"
                                class="text-[10px] font-black uppercase tracking-widest text-stone-500 hover:text-emerald-700 transition-colors border-b-2 border-transparent hover:border-emerald-700 pb-0.5 whitespace-nowrap">
                                Add
                            </button>
                            <span class="text-stone-300">|</span>
                            <button type="submit" name="action" value="buy_now"
                                class="text-[10px] font-black uppercase tracking-widest text-amber-500 hover:text-amber-600 transition-colors border-b-2 border-transparent hover:border-amber-600 pb-0.5 whitespace-nowrap">
                                Order Now
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <section class=" p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <div class="flex items-center p-6 border border-gray-200 rounded-lg shadow-sm">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-emerald-50 rounded-full text-emerald-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Free Delivery</h3>
                    <p class="text-sm text-gray-600">Get your orders delivered to your doorstep for free.</p>
                </div>
            </div>

            <div class="flex items-center p-6 border border-gray-200 rounded-lg shadow-sm">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-emerald-50 rounded-full text-emerald-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">COD Payment</h3>
                    <p class="text-sm text-gray-600">Experience hassle-free  payments with secure.</p>
                </div>
            </div>

            <div class="flex items-center p-6 border border-gray-200 rounded-lg shadow-sm">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-emerald-50 rounded-full text-emerald-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Easy Return</h3>
                    <p class="text-sm text-gray-600">Enjoy easy returns within 30 days of purchase.</p>
                </div>
            </div>

        </div>
    </section>
@endsection
