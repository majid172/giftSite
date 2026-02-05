@extends('layouts.fullscreen')

@section('title', $product->name . ' - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="bg-stone-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm mb-6 text-stone-500">
            <a href="{{ route('home') }}" class="hover:text-amber-500 transition">Home</a>
            <span class="mx-2">•</span>
            <span class="text-stone-800 font-medium truncate max-w-xs">{{ $product->name }}</span>
        </nav>

        <!-- Main Product Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-200 p-6 lg:p-10 mb-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Left: Visuals -->
                <div class="space-y-6">
                    <!-- Main Image Frame -->
                    <div class="bg-stone-50 rounded-2xl p-8 aspect-square flex items-center justify-center relative group overflow-hidden border border-stone-100">
                         <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->name }}" 
                             id="mainImage"
                             class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Thumbnails -->
                    @if($product->images->isNotEmpty())
                    <div class="grid grid-cols-5 gap-3">
                         <button class="aspect-square bg-stone-50 rounded-xl border-2 border-amber-500 p-2 thumbnail-btn active-thumb"
                                onclick="updateMainImage('{{ asset($product->image) }}', this)">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-contain">
                        </button>
                        @foreach($product->images as $img)
                        <button class="aspect-square bg-stone-50 rounded-xl border-2 border-stone-100 hover:border-amber-400 p-2 transition-colors thumbnail-btn"
                                onclick="updateMainImage('{{ asset($img->image_path) }}', this)">
                            <img src="{{ asset($img->image_path) }}" class="w-full h-full object-contain">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right: Information -->
                <div>
                    <!-- Title -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-stone-900 mb-3 leading-tight">{{ $product->name }}</h1>

                    <!-- Rating & Meta -->
                    <div class="flex items-center gap-4 mb-6 text-sm">
                        <div class="flex items-center text-amber-400">
                             @php
                                $avgRating = $product->reviews->avg('rating') ?: 0;
                                $reviewsCount = $product->reviews->count();
                            @endphp
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'fill-current' : 'text-stone-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="ml-2 text-stone-500 font-medium">({{ $reviewsCount }} reviews)</span>
                        </div>
                        <div class="h-4 w-px bg-stone-300"></div>
                        <!-- <span class="text-stone-500">Sold {{ $product->sales_count ?? rand(50, 500) }}</span> -->
                        <!-- <div class="h-4 w-px bg-stone-300"></div> -->
                        <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-blue-500 hover:text-blue-600">{{ $product->category->name ?? 'Store' }}</a>
                    </div>

                    <!-- Price -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-3xl font-bold text-stone-900">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->price, 2) }}</span>
                         @if($product->old_price)
                        <span class="text-lg text-stone-400 line-through decoration-stone-400">{{ get_setting('currency_symbol', '$') }}{{ number_format($product->old_price, 2) }}</span>
                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-1 rounded border border-amber-200">
                             {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% OFF
                        </span>
                        @endif
                    </div>

                    <!-- Description/Features -->
                    <div class="mb-8">
                        <div class="text-stone-600 text-sm leading-relaxed mb-4 line-clamp-3">
                            {!! strip_tags($product->description) !!}
                        </div>
                        
                    </div>
                    
                    <div class="border-t border-dashed border-stone-200 my-6"></div>

                    <form action="{{ route('cart.store') }}" method="POST">
                         @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <input type="hidden" name="quantity" id="selectedQuantity" value="1">

                        <!-- Quantity Filter -->
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-sm font-bold text-stone-800">Quantity:</span>
                            <div class="flex items-center border border-stone-300 rounded-lg bg-white overflow-hidden w-fit">
                                <button type="button" id="decreaseQty" class="px-3 py-2 text-stone-500 hover:text-stone-800 hover:bg-stone-50 transition font-bold text-lg leading-none">-</button>
                                <input type="number" id="quantityInput" value="1" min="1" max="{{ $product->stock > 0 ? $product->stock : 1 }}" class="w-12 text-center border-none p-0 focus:ring-0 text-stone-800 font-bold bg-transparent" readonly>
                                <button type="button" id="increaseQty" class="px-3 py-2 text-stone-500 hover:text-stone-800 hover:bg-stone-50 transition font-bold text-lg leading-none">+</button>
                            </div>
                            @if($product->stock > 0)
                            <span class="text-xs text-teal-600 font-medium bg-teal-50 px-2 py-1 rounded">In Stock: {{ $product->stock }}</span>
                            @else
                            <span class="text-xs text-red-600 font-medium bg-red-50 px-2 py-1 rounded">Out of Stock</span>
                            @endif
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <!-- Order Now (Amber/Orange) -->
                            <button type="submit" name="action" value="buy_now" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 sm:py-4 rounded-full shadow-lg shadow-amber-500/20 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 text-base sm:text-lg" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Order Now
                            </button>

                            <!-- Add to Cart (Teal/Green) -->
                            <button type="submit" name="action" value="add_to_cart" class="flex-1 bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 sm:py-4 rounded-full shadow-lg shadow-teal-700/20 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 text-base sm:text-lg" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    <div class="border-t border-dashed border-stone-200 mt-6 pt-6 space-y-2 text-xs text-stone-500">
                        <div class="flex">
                            <span class="font-bold text-stone-800 w-24">SKU:</span>
                            <span>{{ 'SKU-' . str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex">
                            <span class="font-bold text-stone-800 w-24">Category:</span>
                            @if($product->category)
                            <a href="{{ route('products.index', ['category' => $product->category->id]) }}" class="hover:text-teal-600 transition">{{ $product->category->name }}</a>
                            @else
                            <span>Uncategorized</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description & Reviews Tabs -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-200 overflow-hidden mb-16" x-data="{ activeTab: 'description' }">
            <div class="flex border-b border-stone-200 overflow-x-auto no-scrollbar">
                <button @click="activeTab = 'description'" 
                        :class="{ 'text-teal-700 bg-teal-50 border-teal-700': activeTab === 'description', 'text-stone-500 hover:text-stone-800 border-transparent': activeTab !== 'description' }"
                        class="px-8 py-5 font-bold text-sm uppercase tracking-wider border-b-2 transition-colors whitespace-nowrap">
                    Description
                </button>

                 <button @click="activeTab = 'reviews'" 
                        :class="{ 'text-teal-700 bg-teal-50 border-teal-700': activeTab === 'reviews', 'text-stone-500 hover:text-stone-800 border-transparent': activeTab !== 'reviews' }"
                        class="px-8 py-5 font-bold text-sm uppercase tracking-wider border-b-2 transition-colors whitespace-nowrap">
                    Reviews ({{ $product->reviews->count() }})
                </button>
            </div>
            <div class="p-8 lg:p-12 min-h-[300px]">
                <div x-show="activeTab === 'description'" x-transition.opacity>
                    <!-- <h3 class="text-xl font-bold text-stone-900 mb-4">Product Description</h3> -->
                    @if(strip_tags($product->description))
                    <div class="prose prose-stone max-w-none prose-img:rounded-xl">
                        {!! $product->description !!}
                    </div>
                    @else
                    <div class="flex flex-col items-center justify-center py-12 text-center opacity-60">
                        <svg class="w-16 h-16 text-stone-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-stone-500 font-medium">No description available for this product.</p>
                    </div>
                    @endif
                </div>

                <div x-show="activeTab === 'reviews'" x-transition.opacity style="display: none;">
                    <div class="max-w-3xl">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-bold text-stone-900">Customer Reviews</h3>
                            <button onclick="document.querySelector('#review-form-area').scrollIntoView({behavior: 'smooth'})" class="text-teal-700 font-bold hover:underline">Write a Review</button>
                        </div>
                        
                         @forelse($product->reviews as $review)
                        <div class="mb-8 border-b border-stone-100 pb-8 last:border-0">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 font-bold text-xl">
                                    {{ substr($review->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-bold text-stone-900">{{ $review->user->name ?? $review->guest_name ?? 'Anonymous' }}</h4>
                                        <span class="text-xs text-stone-400">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex text-amber-400 mb-3">
                                        @for($i=1; $i<=5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-stone-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    <p class="text-stone-600 leading-relaxed">{{ $review->review }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-stone-500 italic mb-8">No reviews yet.</p>
                        @endforelse

                        <!-- Simple Review Box (Static for visuals, form submits to existing route) -->
                        <div class="bg-stone-50 rounded-xl p-8" id="review-form-area">
                            <h4 class="font-bold text-stone-900 mb-4">Leave a Review</h4>
                             <form action="{{ route('review.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-stone-700 mb-2">Rating</label>
                                    <div class="flex gap-2 rating-input">
                                        @for($i=1; $i<=5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                            <svg class="w-8 h-8 text-stone-300 peer-checked:text-amber-400 hover:text-amber-400 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        </label>
                                        @endfor
                                    </div>
                                </div>
                                @guest
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-stone-700 mb-2">Name (Optional)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-stone-400 group-focus-within:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="guest_name" class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-200 bg-white focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all shadow-sm placeholder:text-stone-400 font-medium" placeholder="Your Name">
                                    </div>
                                </div>
                                @endguest
                                <div class="mb-4">
                                     <label class="block text-sm font-bold text-stone-700 mb-2">Your Review</label>
                                     <div class="relative">
                                         <div class="absolute top-3 left-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11l5 5h10a2 2 0 00-2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                         </div>
                                         <textarea name="review" rows="4" class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-200 bg-white focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all shadow-sm placeholder:text-stone-400 font-medium" placeholder="Write your experience with this product..."></textarea>
                                     </div>
                                </div>
                                <button type="submit" class="bg-teal-700 text-white font-bold px-6 py-3 rounded-lg hover:bg-teal-800 transition">Submit Review</button>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products (Carousel style layout) -->
        @if($relatedProducts->isNotEmpty())
        <div class="mb-16">
             <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-stone-900">Related Products</h2>
                <a href="#" class="text-teal-700 font-bold text-sm hover:underline">View All</a>
            </div>
             <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-xl border border-stone-200 overflow-hidden hover:shadow-lg transition-all group">
                    <div class="aspect-[4/5] bg-stone-50 relative p-4 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset($related->image) }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                         @if($related->stock <= 0)
                        <div class="absolute inset-0 bg-white/60 flex items-center justify-center backdrop-blur-sm">
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded">SOLD OUT</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                         <h3 class="font-bold text-stone-900 truncate mb-1"><a href="{{ route('product.show', $related->id) }}">{{ $related->name }}</a></h3>
                         <div class="flex items-center justify-between">
                             <span class="text-teal-700 font-bold">${{ number_format($related->price, 2) }}</span>
                             <form action="{{ route('cart.store') }}" method="POST">
                                 @csrf
                                 <input type="hidden" name="id" value="{{ $related->id }}">
                                 <input type="hidden" name="name" value="{{ $related->name }}">
                                 <input type="hidden" name="price" value="{{ $related->price }}">
                                 <input type="hidden" name="image" value="{{ $related->image }}">
                                 <input type="hidden" name="quantity" value="1">
                                 <button type="submit" class="w-8 h-8 rounded-full bg-stone-100 text-stone-500 hover:bg-teal-700 hover:text-white flex items-center justify-center transition" {{ $related->stock <= 0 ? 'disabled' : '' }}>
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                 </button>
                             </form>
                         </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function updateMainImage(src, btn) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail-btn').forEach(b => {
            b.classList.remove('border-amber-500');
            b.classList.add('border-stone-100');
        });
        btn.classList.remove('border-stone-100');
        btn.classList.add('border-amber-500');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Quantity Logic
        const qtyInput = document.getElementById('quantityInput');
        const selQty = document.getElementById('selectedQuantity');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');

        if (qtyInput && decreaseBtn && increaseBtn) {
            decreaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(qtyInput.value) || 1;
                if(currentValue > 1) { 
                    currentValue--; 
                    qtyInput.value = currentValue; 
                    selQty.value = currentValue; 
                }
            });

            increaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(qtyInput.value) || 1;
                let maxStock = parseInt(qtyInput.getAttribute('max')) || 1;
                
                if(currentValue < maxStock) { 
                    currentValue++; 
                    qtyInput.value = currentValue; 
                    selQty.value = currentValue; 
                }
            });
            
            // Prevent manual input outside range
            qtyInput.addEventListener('change', () => {
                let val = parseInt(qtyInput.value) || 1;
                let max = parseInt(qtyInput.getAttribute('max')) || 1;
                if(val < 1) val = 1;
                if(val > max) val = max;
                qtyInput.value = val;
                selQty.value = val;
            });
        }
    });
</script>
@endpush
@endsection
