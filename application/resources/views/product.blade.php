@extends('layouts.fullscreen')

@section('title', 'Product Details - Heritage Gifts')

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
                <li class="text-emerald-700 font-medium">Grand Heritage Box</li>
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
                    <div class="aspect-square relative group">
                        <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=800&q=80" 
                             alt="Grand Heritage Box" 
                             class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">NEW</span>
                            <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">BEST SELLER</span>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="absolute top-4 right-4 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center text-stone-400 hover:text-rose-500 hover:bg-rose-50 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                <div class="grid grid-cols-4 gap-4">
                    @php
                        $thumbnails = [
                            'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=200&q=80',
                            'https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=200&q=80',
                            'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=200&q=80',
                            'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&w=200&q=80',
                        ];
                    @endphp
                    @foreach($thumbnails as $index => $thumb)
                    <button class="aspect-square bg-white rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-amber-500' : 'border-stone-200' }} hover:border-amber-500 transition-all shadow-sm hover:shadow-md">
                        <img src="{{ $thumb }}" alt="Product view {{ $index + 1 }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Details -->
            <div class="space-y-6">
                <!-- Product Title & Rating -->
                <div>
                    <h1 class="text-4xl font-serif font-bold text-emerald-950 mb-3">Grand Heritage Premium Gift Box</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 {{ $i < 5 ? 'text-amber-400 fill-current' : 'text-stone-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-sm text-stone-600">(128 reviews)</span>
                        <span class="text-sm text-emerald-600 font-medium">In Stock</span>
                    </div>
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-black text-emerald-700">$45.00</span>
                    <span class="text-2xl text-stone-400 line-through">$60.00</span>
                    <span class="bg-rose-500 text-white text-sm font-bold px-3 py-1 rounded-full">Save 25%</span>
                </div>

                <!-- Description -->
                <div class="bg-stone-100 rounded-2xl p-6 border border-stone-200">
                    <p class="text-stone-700 leading-relaxed">
                        Elevate your gifting experience with our Grand Heritage Premium Gift Box. Meticulously curated with artisan selections, 
                        this luxurious box features premium tea blends, handcrafted chocolates, and elegant packaging that speaks volumes.
                    </p>
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.store') }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <input type="hidden" name="name" value="Grand Heritage Premium Gift Box">
                    <input type="hidden" name="price" value="45.00">
                    <input type="hidden" name="image" value="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=800&q=80">
                    <input type="hidden" name="size" id="selectedSize" value="Medium">
                    <input type="hidden" name="quantity" id="selectedQuantity" value="1">

                    <!-- Options -->
                    <div class="space-y-4">
                        <!-- Size Selection -->
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-3">Size</label>
                            <div class="flex gap-3">
                                @foreach(['Small', 'Medium', 'Large'] as $index => $size)
                                <button type="button" class="size-btn px-6 py-3 rounded-xl border-2 {{ $index === 1 ? 'border-amber-500 bg-amber-50 text-amber-700' : 'border-stone-200 bg-white text-stone-700' }} font-semibold hover:border-amber-500 hover:bg-amber-50 transition-all" data-size="{{ $size }}">
                                    {{ $size }}
                                </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-3">Quantity</label>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border-2 border-stone-200 rounded-xl overflow-hidden bg-white">
                                    <button type="button" id="decreaseQty" class="px-4 py-3 hover:bg-stone-100 transition-colors text-stone-600 font-bold">-</button>
                                    <input type="number" id="quantityInput" value="1" min="1" max="12" class="w-16 text-center border-none focus:outline-none font-semibold" readonly>
                                    <button type="button" id="increaseQty" class="px-4 py-3 hover:bg-stone-100 transition-colors text-stone-600 font-bold">+</button>
                                </div>
                                <span class="text-sm text-stone-500">Only <span class="font-bold text-emerald-600">12 items</span> left!</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-amber-500/50 hover:shadow-xl hover:shadow-amber-600/50 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Add to Cart
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
                <div class="flex">
                    <button class="px-8 py-4 font-bold text-emerald-700 border-b-2 border-emerald-700">Description</button>
                    <button class="px-8 py-4 font-bold text-stone-500 hover:text-emerald-700 transition">Reviews (128)</button>
                    <button class="px-8 py-4 font-bold text-stone-500 hover:text-emerald-700 transition">Shipping Info</button>
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-serif font-bold text-emerald-950 mb-4">Product Description</h3>
                <div class="prose prose-stone max-w-none">
                    <p class="text-stone-700 leading-relaxed mb-4">
                        Our Grand Heritage Premium Gift Box is the epitome of luxury gifting. Each box is carefully assembled by our expert curators 
                        to ensure a memorable unboxing experience. Perfect for corporate gifts, special occasions, or showing appreciation to loved ones.
                    </p>
                    <h4 class="font-bold text-emerald-950 mt-6 mb-3">What's Included:</h4>
                    <ul class="space-y-2 text-stone-700">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Premium artisan tea selection (3 varieties)
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Handcrafted Belgian chocolates
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Organic honey jar (250ml)
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Luxury gift wrapping with ribbon
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Personalized greeting card
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-serif font-bold text-emerald-950">You May Also Like</h2>
                <a href="{{ route('products.index') }}" class="text-emerald-700 font-bold hover:text-emerald-900 flex items-center gap-2 group">
                    View All
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $relatedProducts = [
                        ['name' => 'Artisan Tea Collection', 'price' => 38.00, 'image' => 'https://images.unsplash.com/photo-1563915027878-3bb14194b859?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Luxury Chocolate Box', 'price' => 42.00, 'image' => 'https://images.unsplash.com/photo-1548907040-4baa42d10919?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Premium Honey Set', 'price' => 28.00, 'image' => 'https://images.unsplash.com/photo-1598462740942-87002573228a?auto=format&fit=crop&w=400&q=80'],
                        ['name' => 'Silk Gift Wrap', 'price' => 15.00, 'image' => 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=400&q=80'],
                    ];
                @endphp

                @foreach($relatedProducts as $product)
                <div class="bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-xl transition-all group">
                    <div class="aspect-square overflow-hidden bg-stone-100">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-emerald-950 mb-2">{{ $product['name'] }}</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-emerald-700">${{ number_format($product['price'], 2) }}</span>
                            <button class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center hover:bg-amber-600 transition shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // Size selection
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active state from all buttons
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('border-amber-500', 'bg-amber-50', 'text-amber-700');
                b.classList.add('border-stone-200', 'bg-white', 'text-stone-700');
            });
            
            // Add active state to clicked button
            this.classList.remove('border-stone-200', 'bg-white', 'text-stone-700');
            this.classList.add('border-amber-500', 'bg-amber-50', 'text-amber-700');
            
            // Update hidden field
            document.getElementById('selectedSize').value = this.dataset.size;
        });
    });

    // Quantity controls
    const quantityInput = document.getElementById('quantityInput');
    const selectedQuantity = document.getElementById('selectedQuantity');
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');

    decreaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            currentValue--;
            quantityInput.value = currentValue;
            selectedQuantity.value = currentValue;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        const maxValue = parseInt(quantityInput.max);
        if (currentValue < maxValue) {
            currentValue++;
            quantityInput.value = currentValue;
            selectedQuantity.value = currentValue;
        }
    });

    // Also update hidden field when input changes directly
    quantityInput.addEventListener('change', function() {
        selectedQuantity.value = this.value;
    });
</script>
@endsection
