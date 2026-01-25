@extends('layouts.fullscreen')

@section('content')



@section('hero')
    <div class="px-4 mt-6">
        <div class="max-w-[1600px] mx-auto">
            <section class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-emerald-900/10 h-[500px] group">
                <div id="slider" class="slider-wrapper h-full">
                    <!-- Slide 1 -->
                    <div class="slide relative bg-emerald-900">
                        <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay" alt="Heritage Packaging">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-transparent"></div>
                        <div class="relative h-full flex flex-col justify-center px-10 md:px-24">
                            <div class="inline-flex items-center gap-2 mb-6">
                                <span class="w-8 h-[2px] bg-amber-500"></span>
                                <span class="text-amber-400 font-bold tracking-[0.2em] text-xs uppercase">Limited Collection</span>
                            </div>
                            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white leading-[1.1] mb-8">
                                Unbox the <br> <span class="text-amber-400 italic">Extraordinary</span>
                            </h1>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="bg-amber-500 hover:bg-amber-400 text-white px-8 py-4 rounded-full font-bold transition-all shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-1">Explore Collection</a>
                                <a href="{{ route('about') }}" class="backdrop-blur-md bg-white/10 border border-white/20 text-white hover:bg-white/20 px-8 py-4 rounded-full font-bold transition-all">Our Story</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('content')
    <div class="space-y-16">
        
        <!-- 1. Shop By Category -->
        <section>
                <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-serif font-bold text-emerald-950">Shop by Category</h2>
                <a href="{{ route('occasions.index') }}" class="text-emerald-700 font-bold text-sm hover:text-emerald-900 transition flex items-center gap-1 group">
                    View all <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Category 1 -->
                <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                    <img src="https://images.unsplash.com/photo-1605648916361-9bd2a99f947b?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Gift Boxes">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-xl font-serif font-bold">Premium Gift Boxes</h3>
                        <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Starting at $45</p>
                    </div>
                </a>
                    <!-- Category 2 -->
                <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                    <img src="https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Tea Sets">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-xl font-serif font-bold">Artisan Tea Sets</h3>
                        <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Exclusive Blends</p>
                    </div>
                </a>
                    <!-- Category 3 -->
                <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                    <img src="https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Festive">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-xl font-serif font-bold">Seasonal Specials</h3>
                        <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Limited Time Only</p>
                    </div>
                </a>
            </div>
        </section>

<!-- Bestselling Products Section -->
<!-- Bestselling Products Section -->
<section class="max-w-7xl mx-auto px-4 py-16">
    <!-- Section Header -->
    <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 text-center lg:text-left">Bestselling Products</h2>
    </div>

    <!-- Main Grid Container: items-stretch ensures equal height for both columns -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        
        <!-- Left Featured Card: Inspired by the Ferrari Image -->
        <div class="lg:col-span-4 flex">
            <div class="relative w-full bg-amber-400 rounded-2xl overflow-hidden flex flex-col items-center pt-12 shadow-xl group">
                
                <!-- Concentric Circles Pattern (Ferrari Style) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="w-[300px] h-[300px] border border-black/5 rounded-full"></div>
                    <div class="w-[500px] h-[500px] border border-black/5 rounded-full absolute"></div>
                    <div class="w-[700px] h-[700px] border border-black/5 rounded-full absolute"></div>
                </div>

                <!-- Text Content (Top Centered) -->
                <div class="relative z-10 text-center px-6">
                    <span class="block text-emerald-950/70 text-sm font-bold tracking-widest uppercase mb-2">
                        Up to 30% Discount
                    </span>
                    <h3 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 leading-tight">
                        Heritage Grand <br>Edition Box
                    </h3>
                </div>

                <!-- Image Content (Bottom Aligned) -->
                <div class="mt-auto w-full relative z-10 flex justify-center translate-y-4 group-hover:translate-y-2 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=600&q=80" 
                         alt="Featured Box" 
                         class="w-[85%] object-contain drop-shadow-[0_25px_25px_rgba(0,0,0,0.3)]">
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
                            'price' => 119.00,
                            'rating' => 5,
                            'reviews' => 3,
                            'badge' => 'NEW',
                            'badge_color' => 'bg-emerald-600',
                            'image' => 'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=400&q=80'
                        ],
                        [
                            'name' => 'Technaxx Heritage Gift Sampler Pack',
                            'price' => 40.50,
                            'old_price' => 45.00,
                            'rating' => 5,
                            'reviews' => 4,
                            'badge' => '-10%',
                            'badge_color' => 'bg-rose-500',
                            'image' => 'https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=400&q=80'
                        ],
                        [
                            'name' => 'Firestone Oval Wide Luxury Box',
                            'price' => 110.00,
                            'rating' => 4,
                            'reviews' => 4,
                            'badge' => null,
                            'image' => 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&w=400&q=80'
                        ]
                    ];
                @endphp

                @foreach($products as $product)
                <div class="bg-white border border-stone-200 rounded-2xl p-5 hover:shadow-2xl transition-all duration-300 group flex flex-col">
                    
                    <!-- Product Image Container -->
                    <div class="relative h-48 mb-6 flex items-center justify-center overflow-hidden">
                        @if($product['badge'])
                            <div class="absolute top-0 left-0 z-10">
                                <span class="{{ $product['badge_color'] }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ $product['badge'] }}</span>
                            </div>
                        @endif
                        
                        <img src="{{ $product['image'] }}" class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500" alt="{{ $product['name'] }}">
                    </div>

                    <!-- Product Info -->
                    <div class="flex flex-col flex-grow">
                        <h4 class="text-sm font-bold text-emerald-950 mb-3 h-10 overflow-hidden leading-tight">
                            {{ $product['name'] }}
                        </h4>

                        <!-- Star Rating (Yellow stars like reference) -->
                        <div class="flex items-center gap-0.5 mb-3">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-3.5 h-3.5 {{ $i < $product['rating'] ? 'text-amber-400' : 'text-stone-200' }} fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="text-xs text-stone-400 ml-1">({{ $product['reviews'] }})</span>
                        </div>

                        <!-- Price -->
                        <div class="flex items-baseline gap-2 mb-5">
                            <span class="text-xl font-bold text-emerald-950">${{ number_format($product['price'], 2) }}</span>
                            @if(isset($product['old_price']))
                                <span class="text-xs text-stone-400 line-through">${{ number_format($product['old_price'], 2) }}</span>
                            @endif
                        </div>

                        <!-- Button (Gray like reference) -->
                        <button class="mt-auto w-full bg-stone-100 hover:bg-emerald-900 hover:text-white text-stone-700 font-bold text-xs uppercase py-3 rounded-full transition-all">
                            Add To Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
        <!-- 2. Featured Products -->
<!-- Featured Products Section -->
<section class="max-w-7xl mx-auto px-4 py-16">
    <!-- Header Section -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="text-3xl font-serif font-bold text-emerald-950 uppercase tracking-tight">Featured Products</h2>
        <div class="h-1 w-20 bg-emerald-900 mt-2 mx-auto md:mx-0"></div>
    </div>

    <!-- Product Grid: Using thin borders to create the cell look from the image -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-stone-200 bg-white shadow-sm">
        @php
            $featuredProducts = [
                ['name' => 'Heritage Grand Leaf Edition Box', 'price' => 119.00, 'rating' => 5, 'reviews' => 3, 'badge' => null, 'image' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=300&q=80', 'action' => 'CUSTOMIZE'],
                ['name' => 'Flexible Sylhet Monsoon Tea Sampler', 'price' => 135.00, 'rating' => 5, 'reviews' => 5, 'badge' => null, 'image' => 'https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=300&q=80', 'action' => 'ADD TO CART'],
                ['name' => 'Artisan Silk Wrapped Luxury Tin', 'price' => 80.00, 'rating' => 4, 'reviews' => 3, 'badge' => null, 'image' => 'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=300&q=80', 'action' => 'ADD TO CART'],
                ['name' => 'Limited Edition Gold Foil Crate', 'price' => 119.00, 'old_price' => 140.00, 'rating' => 5, 'reviews' => 4, 'badge' => '-15%', 'badge_color' => 'bg-rose-500', 'image' => 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&w=300&q=80', 'action' => 'ADD TO CART'],
                ['name' => 'Organic Matcha Ceremonial Set', 'price' => 45.50, 'old_price' => 50.00, 'rating' => 5, 'reviews' => 4, 'badge' => '-9%', 'badge_color' => 'bg-emerald-600', 'image' => 'https://images.unsplash.com/photo-1597481499750-3e6b20975965?auto=format&fit=crop&w=300&q=80', 'action' => 'ADD TO CART'],
                ['name' => 'Corporate Heritage Gifting Bundle', 'price' => 59.00, 'rating' => 4, 'reviews' => 4, 'badge' => 'PACK', 'badge_color' => 'bg-amber-500', 'image' => 'https://images.unsplash.com/photo-1544787210-22bb1c0fd310?auto=format&fit=crop&w=300&q=80', 'action' => 'ADD TO CART'],
            ];
        @endphp

        @foreach($featuredProducts as $product)
        <div class="relative border-r border-b border-stone-200 p-6 flex items-center gap-6 group hover:bg-stone-50 transition-colors duration-300">
            
            <!-- Discount/Pack Badge -->
            @if(isset($product['badge']))
            <div class="absolute top-4 left-4 z-10">
                <span class="{{ $product['badge_color'] }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase">{{ $product['badge'] }}</span>
            </div>
            @endif

            <!-- Left Side: Image -->
            <div class="w-1/3 flex-shrink-0 overflow-hidden">
                <img src="{{ $product['image'] }}" class="w-full h-28 object-contain transform group-hover:scale-110 transition-transform duration-500" alt="{{ $product['name'] }}">
            </div>

            <!-- Right Side: Details -->
            <div class="w-2/3">
                <h3 class="text-sm font-bold text-emerald-950 leading-tight mb-2 h-10 overflow-hidden line-clamp-2">
                    {{ $product['name'] }}
                </h3>

                <!-- Rating -->
                <div class="flex items-center gap-0.5 mb-2">
                    @for($i=0; $i<5; $i++)
                        <svg class="w-3 h-3 {{ $i < $product['rating'] ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                    <span class="text-[10px] text-stone-400 ml-1">({{ $product['reviews'] }})</span>
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-2 mb-3">
                    <span class="text-base font-black text-emerald-950">${{ number_format($product['price'], 2) }}</span>
                    @if(isset($product['old_price']))
                        <span class="text-[11px] text-stone-400 line-through">${{ number_format($product['old_price'], 2) }}</span>
                    @endif
                </div>

                <!-- Action Link -->
                <a href="#" class="text-[11px] font-black uppercase tracking-widest text-stone-500 hover:text-emerald-700 transition-colors border-b-2 border-transparent hover:border-emerald-700 pb-0.5">
                    {{ $product['action'] }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>


        <!-- 3. Latest Products (Redesigned) -->
        <section class="mb-20">
             <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-serif font-bold text-emerald-950">Latest Arrivals</h2>
            </div>
            
            <div class="border border-stone-200 rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-stone-200 bg-white">
                    
                    @php
                        $latestProds = [
                            ['id' => 9, 'name' => 'Automotive Universal Fit Black With Red', 'price' => 72.00, 'rating' => 5, 'reviews' => 3, 'badge' => 'NEW', 'badge_color' => 'bg-emerald-500', 'image' => 'https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=400&q=80'],
                            ['id' => 10, 'name' => 'Aluminum Spacer Quick Steering', 'price' => 119.00, 'old_price' => 140.00, 'rating' => 4, 'reviews' => 2, 'badge' => '-15%', 'badge_color' => 'bg-rose-500', 'image' => 'https://images.unsplash.com/photo-1544787210-22bb1c0fd310?auto=format&fit=crop&w=400&q=80'],
                            ['id' => 11, 'name' => 'Thrustmaster TH8S Shifter Add-On Manual', 'price' => 40.00, 'rating' => 5, 'reviews' => 5, 'image' => 'https://images.unsplash.com/photo-1563915027878-3bb14194b859?auto=format&fit=crop&w=400&q=80'],
                            ['id' => 12, 'name' => 'Black Yellow Wheel Cover 13 Inch', 'price' => 119.00, 'rating' => 5, 'reviews' => 3, 'image' => 'https://images.unsplash.com/photo-1595995574040-058df5d064dd?auto=format&fit=crop&w=400&q=80'],
                        ];
                    @endphp

                    @foreach($latestProds as $item)
                    <div class="group relative p-6 hover:shadow-2xl transition-shadow duration-300 z-0 hover:z-10 bg-white">
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">
                            @if(isset($item['badge']))
                                <span class="{{ $item['badge_color'] }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wide">{{ $item['badge'] }}</span>
                            @endif
                        </div>

                        <!-- Hover Actions -->
                        <div class="absolute top-4 right-4 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-x-2 group-hover:translate-x-0">
                            <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Wishlist">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                            <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Compare">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </button>
                            <button class="w-8 h-8 rounded-full bg-white border border-stone-200 text-stone-500 hover:bg-amber-500 hover:text-white hover:border-amber-500 flex items-center justify-center transition shadow-sm" title="Quick View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>

                        <!-- Image -->
                        <div class="h-48 mb-4 overflow-hidden relative flex items-center justify-center">
                            <img src="{{ $item['image'] }}" class="max-h-full max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500" alt="{{ $item['name'] }}">
                        </div>

                        <!-- Content -->
                        <div class="text-left">
                            <h3 class="font-bold text-emerald-950 text-sm mb-2 h-10 overflow-hidden line-clamp-2 leading-tight">
                                <a href="#" class="hover:text-amber-500 transition">{{ $item['name'] }}</a>
                            </h3>
                            
                            <!-- Ratings -->
                            <div class="flex items-center gap-0.5 mb-2">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i < $item['rating'] ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                                <span class="text-xs text-stone-400 ml-1">({{ $item['reviews'] }})</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-5 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-emerald-950">${{ number_format($item['price'], 2) }}</span>
                                @if(isset($item['old_price']))
                                    <span class="text-sm text-stone-400 line-through decoration-stone-400 decoration-1">${{ number_format($item['old_price'], 2) }}</span>
                                @endif
                            </div>

                            <!-- Add to Cart Button -->
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                <input type="hidden" name="name" value="{{ $item['name'] }}">
                                <input type="hidden" name="price" value="{{ $item['price'] }}">
                                <input type="hidden" name="image" value="{{ $item['image'] }}">
                                <button type="submit" class="w-full bg-stone-100 hover:bg-amber-400 text-stone-800 hover:text-white font-bold text-xs uppercase tracking-wider py-3 rounded-full transition-all duration-300 shadow-sm hover:shadow-md">
                                    Add To Cart
                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
