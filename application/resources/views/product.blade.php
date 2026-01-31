@extends('layouts.fullscreen')

@section('title', $product->name . ' - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="bg-stone-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-stone-500 hover:text-emerald-700 transition">Home</a></li>
                <li><svg class="w-4 h-4 text-stone-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                <li><a href="{{ route('products.index') }}" class="text-stone-500 hover:text-emerald-700 transition">Products</a></li>
                <li><svg class="w-4 h-4 text-stone-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                <li class="text-emerald-700 font-medium truncate max-w-xs">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative flex items-center gap-3" role="alert">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Main Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            
            <!-- Left: Image Gallery -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-stone-200 p-8">
                    <div class="aspect-square relative group bg-white flex items-center justify-center">
                        <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->name }}" 
                             id="mainImage"
                             class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                             @if($product->badge)
                                <span class="{{ $product->badge_color ?? 'bg-amber-500' }} text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wide shadow-lg">{{ $product->badge }}</span>
                            @endif
                        </div>

                        <!-- Wishlist Button -->
                        @php
                            $isInWishlist = false;
                            if(auth()->check()) {
                                $isInWishlist = auth()->user()->wishlist()->where('product_id', $product->id)->exists();
                            }
                        @endphp
                        <button onclick="toggleWishlist({{ $product->id }})" 
                                id="wishlist-btn-{{ $product->id }}"
                                class="absolute top-4 right-4 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center transition-all hover:bg-rose-50 {{ $isInWishlist ? 'text-rose-500' : 'text-stone-400 hover:text-rose-500' }}">
                            <svg class="w-6 h-6 {{ $isInWishlist ? 'fill-current' : '' }}" id="wishlist-icon-{{ $product->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                @if($product->images->isNotEmpty())
                <div class="grid grid-cols-4 gap-4">
                     <!-- Main image thumbnail -->
                    <button class="aspect-square bg-white rounded-xl overflow-hidden border-2 border-stone-200 hover:border-amber-500 transition-all shadow-sm hover:shadow-md thumbnail-btn active-thumb"
                            onclick="updateMainImage('{{ asset($product->image) }}', this)">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-2">
                    </button>

                    @foreach($product->images as $img)
                    <button class="aspect-square bg-white rounded-xl overflow-hidden border-2 border-stone-200 hover:border-amber-500 transition-all shadow-sm hover:shadow-md thumbnail-btn"
                            onclick="updateMainImage('{{ asset($img->image_path) }}', this)">
                        <img src="{{ asset($img->image_path) }}" alt="Product view" class="w-full h-full object-contain p-2">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Right: Product Details -->
            <div class="space-y-6">
                <!-- Product Title & Rating -->
                <div>
                    <h1 class="text-4xl font-serif font-bold text-emerald-950 mb-3">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            @php
                                $avgRating = $product->reviews->avg('rating') ?: 0;
                                $reviewsCount = $product->reviews->count();
                            @endphp
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-sm text-stone-600">({{ $reviewsCount }} reviews)</span>
                        
                        @if($product->stock > 0)
                            <span class="text-sm text-emerald-600 font-medium">In Stock</span>
                        @else
                            <span class="text-sm text-red-600 font-medium">Out of Stock</span>
                        @endif
                    </div>
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-black text-emerald-700">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->price, 2) }}</span>
                    @if($product->old_price)
                        <span class="text-2xl text-stone-400 line-through">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->old_price, 2) }}</span>
                        @php
                            $discount = (($product->old_price - $product->price) / $product->old_price) * 100;
                        @endphp
                        <span class="bg-rose-500 text-white text-sm font-bold px-3 py-1 rounded-full">Save {{ round($discount) }}%</span>
                    @endif
                </div>

                <!-- Description Summary-->
                 <div class="bg-stone-100 rounded-2xl p-6 border border-stone-200">
                    <p class="text-stone-700 leading-relaxed line-clamp-3">
                         {!! strip_tags($product->description) !!}
                    </p>
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.store') }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $product->image }}">
                    <input type="hidden" name="quantity" id="selectedQuantity" value="1">

                    <!-- Options -->
                    <div class="space-y-4">
                        
                        <!-- Quantity -->
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-3">Quantity</label>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border-2 border-stone-200 rounded-xl overflow-hidden bg-white">
                                    <button type="button" id="decreaseQty" class="px-4 py-3 hover:bg-stone-100 transition-colors text-stone-600 font-bold">-</button>
                                    <input type="number" id="quantityInput" value="1" min="1" max="{{ $product->stock > 0 ? $product->stock : 1 }}" class="w-16 text-center border-none focus:outline-none font-semibold" readonly>
                                    <button type="button" id="increaseQty" class="px-4 py-3 hover:bg-stone-100 transition-colors text-stone-600 font-bold">+</button>
                                </div>
                                <span class="text-sm text-stone-500">
                                    @if($product->stock > 0)
                                        Only <span class="font-bold text-emerald-600">{{ $product->stock }} items</span> left!
                                    @else
                                        <span class="font-bold text-red-600">Sold Out</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-amber-500/50 hover:shadow-xl hover:shadow-amber-600/50 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                        <button type="button" class="px-6 py-4 border-2 border-emerald-700 text-emerald-700 font-bold rounded-xl hover:bg-emerald-700 hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </button>
                    </div>
                </form>

                <!-- Features -->
                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-stone-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-stone-700">Free Shipping</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-stone-700">Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-stone-700">Easy Returns</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-stone-700">24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="bg-white rounded-3xl shadow-xl border border-stone-200 overflow-hidden mb-16">
            <div class="border-b border-stone-200">
                <div class="flex gap-4 px-8">
                    <button class="px-4 py-4 font-bold text-emerald-700 border-b-2 border-emerald-700 transition tab-btn" data-tab="description">Description</button>
                    <button class="px-4 py-4 font-bold text-stone-500 hover:text-emerald-700 transition border-b-2 border-transparent tab-btn" data-tab="reviews">Reviews ({{ $reviewsCount }})</button>
                    <!-- <button class="px-8 py-4 font-bold text-stone-500 hover:text-emerald-700 transition">Shipping Info</button> -->
                </div>
            </div>
            <div class="p-8">
                <!-- Description Tab -->
                <div id="description-tab" class="tab-content">
                    <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-4">Product Description</h3>
                    <div class="prose prose-stone max-w-none">
                       {!! $product->description !!}
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviews-tab" class="hidden tab-content">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Reviews List -->
                        <div class="space-y-8">
                            <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-4">Customer Reviews</h3>
                            
                            @forelse($product->reviews as $review)
                            <div class="border-b border-stone-200 pb-8 last:border-0 last:pb-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">
                                            {{ substr($review->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-emerald-950">{{ $review->user->name ?? 'Anonymous' }}</h4>
                                            <span class="text-xs text-stone-500">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex text-amber-400">
                                        @for($i=1; $i<=5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->review)
                                <p class="text-stone-600 leading-relaxed">{{ $review->review }}</p>
                                @endif
                                <!-- Status badge if needed -->
                                @if($review->status === 'pending')
                                    <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-full mt-2 inline-block">Pending Approval</span>
                                @endif
                            </div>
                            @empty
                            <p class="text-stone-500 italic">No reviews yet. Be the first to write one!</p>
                            @endforelse
                        </div>

                        <!-- Write Review Form -->
                        <div class="bg-stone-50 p-8 rounded-3xl border border-stone-200 h-fit">
                            <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-6">Write a Review</h3>
                            
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <div class="text-center py-8">
                                        <svg class="w-16 h-16 text-stone-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        <p class="text-stone-600">Administrators cannot submit reviews.</p>
                                    </div>
                                @else
                                    <form action="{{ route('review.store', $product->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-6">
                                            <label class="block text-sm font-bold text-stone-700 mb-2">Rating</label>
                                            <div class="flex items-center gap-2 rating-input">
                                                @for($i=1; $i<=5; $i++)
                                                <label class="cursor-pointer group">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                                                    <svg class="w-8 h-8 text-stone-300 group-hover:text-amber-400 peer-checked:text-amber-400 star-d transition-colors" fill="currentColor" viewBox="0 0 20 20" data-val="{{ $i }}"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                </label>
                                                @endfor
                                            </div>
                                            @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-6">
                                            <label for="review" class="block text-sm font-bold text-stone-700 mb-2">Your Review (Optional)</label>
                                            <textarea name="review" id="review" rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-stone-200 focus:border-emerald-500 focus:outline-none transition-colors" placeholder="Share your thoughts about this product..."></textarea>
                                            @error('review') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-1">Submit Review</button>
                                    </form>
                                @endif
                            @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-stone-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <p class="text-stone-600 mb-4">Please log in to write a review.</p>
                                <a href="{{ route('login') }}" class="inline-block bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl hover:bg-emerald-800 transition">Log In</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products (Same Category) -->
        @if($relatedProducts->isNotEmpty())
        <div class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-serif font-bold text-emerald-950">More from {{ $product->category->name }}</h2>
                <a href="{{ route('products.index') }}" class="text-emerald-700 font-bold hover:text-emerald-900 flex items-center gap-2 group">
                    View All
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-xl transition-all group">
                    <div class="aspect-square overflow-hidden bg-stone-100 flex items-center justify-center p-4">
                        <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-emerald-950 mb-2 truncate" title="{{ $related->name }}">
                            <a href="{{ route('product.show', $related->id) }}">{{ $related->name }}</a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-emerald-700">${{ number_format($related->price, 2) }}</span>
                                @if($related->category)
                                <span class="text-xs text-stone-500">{{ $related->category->name }}</span>
                                @endif
                            </div>
                            <a href="{{ route('product.show', $related->id) }}" class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center hover:bg-amber-600 transition shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Other Categories -->
        @if(isset($otherCategories) && $otherCategories->isNotEmpty())
            @foreach($otherCategories as $cat)
                @if($cat->products->isNotEmpty())
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-amber-500 font-bold uppercase tracking-wider text-sm mb-1 block">Discover</span>
                            <h2 class="text-3xl font-serif font-bold text-emerald-950">Best of {{ $cat->name }}</h2>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-emerald-700 font-bold hover:text-emerald-900 flex items-center gap-2 group">
                            Explore {{ $cat->name }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($cat->products as $related)
                        <div class="bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-xl transition-all group">
                            <div class="aspect-square overflow-hidden bg-stone-100 flex items-center justify-center p-4">
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-emerald-950 mb-2 truncate" title="{{ $related->name }}">
                                    <a href="{{ route('product.show', $related->id) }}">{{ $related->name }}</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-emerald-700">${{ number_format($related->price, 2) }}</span>
                                    <a href="{{ route('product.show', $related->id) }}" class="w-10 h-10 rounded-full bg-white border border-stone-200 text-stone-400 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 flex items-center justify-center transition shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
</div>

<script>
    function toggleWishlist(productId) {
        @guest
            window.location.href = "{{ route('login') }}";
            return;
        @endguest

        fetch("{{ route('wishlist.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            const btn = document.getElementById(`wishlist-btn-${productId}`);
            const icon = document.getElementById(`wishlist-icon-${productId}`);
            
            if (data.status === 'added') {
                btn.classList.remove('text-stone-400');
                btn.classList.add('text-rose-500');
                icon.classList.add('fill-current');
            } else {
                btn.classList.add('text-stone-400');
                btn.classList.remove('text-rose-500');
                icon.classList.remove('fill-current');
            }
            
            // Optional: Show a toast or notification
            // alert(data.message); 
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updateMainImage(src, btn) {
        // Update main image
        const mainImage = document.getElementById('mainImage');
        mainImage.style.opacity = '0';
        
        setTimeout(() => {
            mainImage.src = src;
            mainImage.style.opacity = '1';
        }, 300);

        // Update active state of thumbnails
        document.querySelectorAll('.thumbnail-btn').forEach(b => {
            b.classList.remove('border-amber-500', 'active-thumb');
            b.classList.add('border-stone-200');
        });
        
        btn.classList.remove('border-stone-200');
        btn.classList.add('border-amber-500', 'active-thumb');
    }

    // Quantity controls
    const quantityInput = document.getElementById('quantityInput');
    const selectedQuantity = document.getElementById('selectedQuantity');
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');

    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                currentValue--;
                quantityInput.value = currentValue;
                selectedQuantity.value = currentValue;
            }
        });
    }

    if (increaseBtn) {
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max);
            if (currentValue < maxValue) {
                currentValue++;
                quantityInput.value = currentValue;
                selectedQuantity.value = currentValue;
            }
        });
    }

    // Also update hidden field when input changes directly
    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            selectedQuantity.value = this.value;
        });
    }

    // Tabs functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Deactivate all buttons
            tabBtns.forEach(b => {
                b.classList.remove('text-emerald-700', 'border-emerald-700');
                b.classList.add('text-stone-500', 'border-transparent');
            });
            // Activate clicked button
            btn.classList.remove('text-stone-500', 'border-transparent');
            btn.classList.add('text-emerald-700', 'border-emerald-700');

            // Hide all contents
            tabContents.forEach(c => c.classList.add('hidden'));
            // Show target content
            document.getElementById(btn.dataset.tab + '-tab').classList.remove('hidden');
        });
    });

    // Star rating interaction
    const starLabels = document.querySelectorAll('.rating-input label');
    const stars = document.querySelectorAll('.rating-input .star-d');

    starLabels.forEach((label, index) => {
        label.addEventListener('mouseover', () => {
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('text-amber-400');
                    s.classList.remove('text-stone-300');
                } else {
                    s.classList.remove('text-amber-400');
                    s.classList.add('text-stone-300');
                }
            });
        });

        label.addEventListener('click', () => {
             // Reset logic handled by CSS peer-checked, 
             // but we might want to persist hover state or just let CSS handle it.
             // With peer-checked CSS we might not need this JS, but for better hover effects:
             
             // Actually, let's just stick to CSS peer-checked if possible, 
             // but 'star-d' class needs to be handled.
             // Let's implement simple JS for updating visual state based on selection.
             
             stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('fill-current'); 
                } else {
                    s.classList.remove('fill-current');
                }
             });
        });
    });

    const ratingContainer = document.querySelector('.rating-input');
    if(ratingContainer) {
        ratingContainer.addEventListener('mouseleave', () => {
            // Restore state based on checked input
            const checkedInput = ratingContainer.querySelector('input:checked');
            if(checkedInput) {
                const checkedIndex = parseInt(checkedInput.value) - 1;
                stars.forEach((s, i) => {
                    if (i <= checkedIndex) {
                        s.classList.add('text-amber-400');
                        s.classList.remove('text-stone-300');
                    } else {
                        s.classList.remove('text-amber-400');
                        s.classList.add('text-stone-300');
                    }
                });
            } else {
                // none checked, clear
                stars.forEach(s => {
                    s.classList.remove('text-amber-400');
                    s.classList.add('text-stone-300');
                });
            }
        });
    }
</script>
@endsection
