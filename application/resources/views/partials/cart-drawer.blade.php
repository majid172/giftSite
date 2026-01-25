<!-- Cart Drawer Overlay -->
<div id="cart-drawer-backdrop" class="fixed inset-0 bg-black/50 z-50 hidden transition-opacity duration-300 opacity-0" aria-hidden="true"></div>

<!-- Cart Drawer Panel -->
<div id="cart-drawer" class="fixed inset-y-0 right-0 max-w-md w-full bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
    
    <!-- Drawer Header -->
    <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
        <h2 class="text-xl font-serif font-bold text-emerald-950">Shopping Cart</h2>
        <button id="close-cart-drawer" class="text-stone-400 hover:text-rose-500 transition-colors p-2 rounded-full hover:bg-stone-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Drawer Content (Scrollable) -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6">
        @if(session('cart') && count(session('cart')) > 0)
            @foreach(session('cart') as $id => $details)
                <div class="flex gap-4 group">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-stone-100 flex-shrink-0 border border-stone-100">
                        <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start">
                                <h3 class="font-serif font-bold text-emerald-950 text-sm leading-tight">{{ $details['name'] }}</h3>
                                <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-stone-400 hover:text-rose-500 transition-colors ml-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                            <p class="text-xs text-stone-500 mt-1">Price: ${{ number_format($details['price'], 2) }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-stone-100 text-xs font-bold text-stone-600">Qty: {{ $details['quantity'] }}</span>
                            <span class="text-emerald-700 font-bold text-sm">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="h-full flex flex-col items-center justify-center text-center space-y-4">
                <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <div>
                    <p class="text-emerald-950 font-bold">Your cart is empty</p>
                    <p class="text-sm text-stone-500 mt-1">Add items to get started.</p>
                </div>
                <a href="{{ route('products.index') }}" onclick="closeCart()" class="text-amber-500 hover:text-amber-600 text-sm font-bold mt-2">Continue Shopping &rarr;</a>
            </div>
        @endif
    </div>

    <!-- Drawer Footer -->
    @if(session('cart') && count(session('cart')) > 0)
        @php
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp
        <div class="border-t border-stone-100 p-6 bg-stone-50/50">
            <div class="flex justify-between mb-4 text-emerald-950 font-bold text-lg">
                <span>Subtotal</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('cart') }}" class="block text-center px-4 py-3 border border-stone-300 rounded-full text-stone-700 font-bold hover:bg-stone-50 transition-colors">View Cart</a>
                <a href="{{ route('checkout') }}" class="block text-center px-4 py-3 bg-emerald-900 text-white rounded-full font-bold shadow-lg hover:bg-emerald-800 transition-colors">Checkout</a>
            </div>
        </div>
    @endif
</div>

<script>
    const drawer = document.getElementById('cart-drawer');
    const backdrop = document.getElementById('cart-drawer-backdrop');
    const closeBtn = document.getElementById('close-cart-drawer');
    
    // Function to Open Drawer (Expose globally if needed)
    window.openCart = function() {
        backdrop.classList.remove('hidden');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            drawer.classList.remove('translate-x-full');
        }, 10);
    }

    // Function to Close Drawer
    window.closeCart = function() {
        backdrop.classList.add('opacity-0');
        drawer.classList.add('translate-x-full');
        
        // Wait for transition to finish before hiding backdrop
        setTimeout(() => {
            backdrop.classList.add('hidden');
        }, 300);
    }

    // Event Listeners
    if(closeBtn) closeBtn.addEventListener('click', closeCart);
    if(backdrop) backdrop.addEventListener('click', closeCart);
    
    // Listen for custom 'open-cart' event using document
    document.addEventListener('open-cart', openCart);
</script>
