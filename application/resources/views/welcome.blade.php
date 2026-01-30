@extends('layouts.fullscreen')

@section('content')

@section('hero')
    <section class="relative w-full bg-emerald-950 overflow-hidden font-sans">

        <!-- Desktop Image (Absolute Right Half) -->
        <div class="hidden lg:block absolute inset-y-0 right-0 w-1/2">
            <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1920&q=80"
                class="w-full h-full object-cover" alt="{{ get_setting('site_name', config('app.name')) }} Packaging">
            <div class="absolute inset-0 bg-emerald-950/20 mix-blend-multiply"></div>
        </div>

        <!-- Content Container (Aligns with Page) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 min-h-[600px] lg:h-[85vh] max-h-[900px]">

                <!-- Left Content -->
                <div class="flex flex-col justify-center py-20 lg:py-0 order-2 lg:order-1">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <span class="w-12 h-[1px] bg-amber-500"></span>
                        <span class="text-amber-400 font-bold tracking-[0.2em] text-xs uppercase">Limited Collection</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-7xl font-serif font-bold text-white leading-[1.1] mb-8">
                        Unbox the <br> <span class="text-amber-400 italic">Extraordinary</span>
                    </h1>

                    <p class="text-emerald-100/80 text-lg mb-10 max-w-lg leading-relaxed">
                        Elevate your gifting experience with our curated collection of premium artisanal boxes, designed to
                        create unforgettable moments.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products.index') }}"
                            class="bg-amber-500 hover:bg-amber-400 text-white px-10 py-4 rounded-full font-bold transition-all shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-1 tracking-wide">
                            Explore Collection
                        </a>
                        <a href="{{ route('about') }}"
                            class="group flex items-center gap-2 text-white px-8 py-4 font-bold transition-all hover:text-amber-400">
                            Our Story
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Mobile Image (Visible only on lg-) -->
                <div class="lg:hidden h-[400px] w-full order-1 relative">
                    <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1920&q=80"
                        class="absolute inset-0 w-full h-full object-cover" alt="{{ get_setting('site_name', config('app.name')) }} Packaging">
                    <div class="absolute inset-0 bg-emerald-950/20 mix-blend-multiply"></div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('content')
    <section>
        <div class="space-y-16">

            <!-- 1. Shop By Category -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950">Shop by Category</h2>
                    <a href="{{ route('categories.index') }}"
                        class="text-emerald-700 font-bold text-sm hover:text-emerald-900 transition flex items-center gap-1 group">
                        View all <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                        <img src="{{ asset('assets/images/'.$category->image) }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            alt="{{ $category->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-serif font-bold">{{ $category->name }}</h3>
                           <span class="inline-flex items-center text-amber-400 font-bold text-xs uppercase tracking-widest gap-2">
                    Explore Collection
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </span>
                        </div>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 h-full">
                        @php
                            $products = [
                                [
                                    'name' => 'Signature Tea Chest with Ribbon',
                                    'price' => 119.0,
                                    'rating' => 5,
                                    'reviews' => 3,
                                    'badge' => 'NEW',
                                    'badge_color' => 'bg-emerald-600',
                                    'image' =>
                                        'https://images.unsplash.com/photo-1497700003451-e1df943a194b?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                                ],
                                [
                                    'name' => 'Technaxx ' . get_setting('site_name', config('app.name')) . ' Gift Sampler Pack',
                                    'price' => 40.5,
                                    'old_price' => 45.0,
                                    'rating' => 5,
                                    'reviews' => 4,
                                    'badge' => '-10%',
                                    'badge_color' => 'bg-rose-500',
                                    'image' =>
                                        'https://plus.unsplash.com/premium_photo-1661547926513-d3cb4eadd310?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                                ],
                                [
                                    'name' => 'Firestone Oval Wide Luxury Box',
                                    'price' => 110.0,
                                    'rating' => 4,
                                    'reviews' => 4,
                                    'badge' => null,
                                    'image' =>
                                        'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&w=400&q=80',
                                ],
                            ];
                        @endphp

                        @foreach ($products as $product)
                            <div
                                class="bg-white border border-stone-200 rounded-2xl p-5 hover:shadow-2xl transition-all duration-300 group flex flex-col">

                                <!-- Product Image Container -->
                                <div class="relative h-48 mb-6 flex items-center justify-center overflow-hidden">
                                    @if ($product['badge'])
                                        <div class="absolute top-0 left-0 z-10">
                                            <span
                                                class="{{ $product['badge_color'] }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ $product['badge'] }}</span>
                                        </div>
                                    @endif

                                    <img src="{{ $product['image'] }}"
                                        class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500"
                                        alt="{{ $product['name'] }}">
                                </div>

                                <!-- Product Info -->
                                <div class="flex flex-col flex-grow">
                                    <h4 class="text-sm font-bold text-emerald-950 mb-3 h-10 overflow-hidden leading-tight">
                                        {{ $product['name'] }}
                                    </h4>

                                    <!-- Star Rating (Yellow stars like reference) -->
                                    <div class="flex items-center gap-0.5 mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-3.5 h-3.5 {{ $i < $product['rating'] ? 'text-amber-400' : 'text-stone-200' }} fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="text-xs text-stone-400 ml-1">({{ $product['reviews'] }})</span>
                                    </div>

                                    <!-- Price -->
                                    <div class="flex items-baseline gap-2 mb-5">
                                        <span
                                            class="text-xl font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($product['price'], 2) }}</span>
                                        @if (isset($product['old_price']))
                                            <span
                                                class="text-xs text-stone-400 line-through">{{ get_setting('currency_symbol', '$') }}{{ number_format($product['old_price'], 2) }}</span>
                                        @endif
                                    </div>

                                    <!-- Button (Gray like reference) -->
                                    <button
                                        class="mt-auto w-full bg-stone-100 hover:bg-emerald-900 hover:text-white text-stone-700 font-bold text-xs uppercase py-3 rounded-full transition-all">
                                        Add To Cart
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- 3. Latest Products (Redesigned) -->
    <section class="my-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950">Latest Arrivals</h2>
        </div>

        <div class="border border-stone-200 rounded-lg overflow-hidden">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-stone-200 bg-white">

                @foreach ($latestProds as $item)
                    <div
                        class="group relative p-6 hover:shadow-2xl transition-shadow duration-300 z-0 hover:z-10 bg-white">

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">
                            @if ($item->badge)
                                <span
                                    class="{{ $item->badge_color ?? 'bg-emerald-500' }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wide">{{ $item->badge }}</span>
                            @endif
                        </div>

                        <!-- Hover Actions -->
                        <div
                            class="absolute top-4 right-4 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-x-2 group-hover:translate-x-0">
                            <button
                                class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm"
                                title="Wishlist">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                            <button
                                class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm"
                                title="Compare">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </button>
                            <button
                                class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm"
                                title="Quick View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <!-- Image -->
                        <div class="h-48 mb-4 overflow-hidden relative flex items-center justify-center">
                            <img src="{{ asset($item->image) }}"
                                class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500"
                                alt="{{ $item->name }}">
                        </div>

                        <!-- Content -->
                        <div class="text-left">
                            <h3
                                class="font-bold text-emerald-950 text-sm mb-2 h-10 overflow-hidden line-clamp-2 leading-tight">
                                <a href="{{ route('product.show', $item->id) }}" class="hover:text-amber-500 transition">{{ $item->name }}</a>
                            </h3>

                            <!-- Ratings -->
                            <div class="flex items-center gap-0.5 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i < 5 ? 'text-amber-400 fill-current' : 'text-stone-300' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="text-xs text-stone-400 ml-1">(5)</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-5 flex items-baseline gap-2">
                                <span
                                    class="text-lg font-bold text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->price, 2) }}</span>
                                @if ($item->old_price)
                                    <span
                                        class="text-sm text-stone-400 line-through decoration-stone-400 decoration-1">{{ get_setting('currency_symbol', '$') }}{{ number_format($item->old_price, 2) }}</span>
                                @endif
                            </div>

                            <!-- Add to Cart Button -->
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="name" value="{{ $item->name }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                                <input type="hidden" name="image" value="{{ $item->image }}">
                                <button type="submit"
                                    class="w-full bg-stone-100 hover:bg-emerald-900 text-stone-800 hover:text-white font-bold text-xs uppercase tracking-wider py-3 rounded-full transition-all duration-300 shadow-sm hover:shadow-md">
                                    Add To Cart
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- 2. Featured Products -->
    <!-- Featured Products Section -->
    <section class="py-16">
        <!-- Header Section -->
        <div class="mb-8 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 uppercase tracking-tight">Featured
                Products</h2>
            <div class="h-1 w-20 bg-emerald-900 mt-2 mx-auto md:mx-0"></div>
        </div>

        <!-- Product Grid: Using thin borders to create the cell look from the image -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-stone-200 bg-white shadow-sm">
            @php
                $featuredProducts = [
                    [
                        'name' => get_setting('site_name', config('app.name')) . ' Grand Leaf Edition Box',
                        'price' => 119.0,
                        'rating' => 5,
                        'reviews' => 3,
                        'badge' => null,
                        'image' =>
                            'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=300&q=80',
                        'action' => 'CUSTOMIZE',
                    ],
                    [
                        'name' => 'Flexible Sylhet Monsoon Tea Sampler',
                        'price' => 135.0,
                        'rating' => 5,
                        'reviews' => 5,
                        'badge' => null,
                        'image' =>
                            'https://images.unsplash.com/photo-1679452233773-b02d98c6c83c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'action' => 'ADD TO CART',
                    ],
                    [
                        'name' => 'Artisan Silk Wrapped Luxury Tin',
                        'price' => 80.0,
                        'rating' => 4,
                        'reviews' => 3,
                        'badge' => null,
                        'image' =>
                            'https://images.unsplash.com/photo-1599910490526-260dbce86aa0?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'action' => 'ADD TO CART',
                    ],
                    [
                        'name' => 'Limited Edition Gold Foil Crate',
                        'price' => 119.0,
                        'old_price' => 140.0,
                        'rating' => 5,
                        'reviews' => 4,
                        'badge' => '-15%',
                        'badge_color' => 'bg-rose-500',
                        'image' =>
                            'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&w=300&q=80',
                        'action' => 'ADD TO CART',
                    ],
                    [
                        'name' => 'Organic Matcha Ceremonial Set',
                        'price' => 45.5,
                        'old_price' => 50.0,
                        'rating' => 5,
                        'reviews' => 4,
                        'badge' => '-9%',
                        'badge_color' => 'bg-emerald-600',
                        'image' =>
                            'https://images.unsplash.com/photo-1573168549138-2636bbdba606?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'action' => 'ADD TO CART',
                    ],
                    [
                        'name' => 'Corporate ' . get_setting('site_name', config('app.name')) . ' Gifting Bundle',
                        'price' => 59.0,
                        'rating' => 4,
                        'reviews' => 4,
                        'badge' => 'PACK',
                        'badge_color' => 'bg-amber-500',
                        'image' =>
                            'https://images.unsplash.com/photo-1614631016624-cb89bceec02c?q=80&w=1029&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'action' => 'ADD TO CART',
                    ],
                ];
            @endphp

            @foreach ($featuredProducts as $product)
                <div
                    class="relative border-r border-b border-stone-200 p-6 flex items-center gap-6 group hover:bg-stone-50 transition-colors duration-300">

                    <!-- Discount/Pack Badge -->
                    @if (isset($product['badge']))
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="{{ $product['badge_color'] }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ $product['badge'] }}</span>
                        </div>
                    @endif

                    <!-- Left Side: Image -->
                    <div class="w-1/3 flex-shrink-0 overflow-hidden">
                        <img src="{{ $product['image'] }}"
                            class="w-full h-28 object-contain transform group-hover:scale-110 transition-transform duration-500"
                            alt="{{ $product['name'] }}">
                    </div>

                    <!-- Right Side: Details -->
                    <div class="w-2/3">
                        <h3
                            class="text-sm font-bold text-emerald-950 leading-tight mb-2 h-10 overflow-hidden line-clamp-2">
                            {{ $product['name'] }}
                        </h3>

                        <!-- Rating -->
                        <div class="flex items-center gap-0.5 mb-2">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-3 h-3 {{ $i < $product['rating'] ? 'text-amber-400 fill-current' : 'text-stone-300' }}"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="text-[10px] text-stone-400 ml-1">({{ $product['reviews'] }})</span>
                        </div>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-3">
                            <span
                                class="text-base font-black text-emerald-950">{{ get_setting('currency_symbol', '$') }}{{ number_format($product['price'], 2) }}</span>
                            @if (isset($product['old_price']))
                                <span
                                    class="text-[11px] text-stone-400 line-through">{{ get_setting('currency_symbol', '$') }}{{ number_format($product['old_price'], 2) }}</span>
                            @endif
                        </div>

                        <!-- Action Link -->
                        <a href="#"
                            class="text-[11px] font-black uppercase tracking-widest text-stone-500 hover:text-emerald-700 transition-colors border-b-2 border-transparent hover:border-emerald-700 pb-0.5">
                            {{ $product['action'] }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>




    <section class=" p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <div class="flex items-center p-6 border border-gray-200 rounded-lg shadow-sm">
                <div
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-50 rounded-full text-indigo-600 mr-4">
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
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-50 rounded-full text-indigo-600 mr-4">
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
                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-50 rounded-full text-indigo-600 mr-4">
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
