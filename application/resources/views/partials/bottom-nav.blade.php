@php
    function navIsActive($routes) {
        foreach((array)$routes as $route) {
            if (request()->routeIs($route)) return true;
        }
        return false;
    }
@endphp

<div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.04)] px-1 sm:px-2 flex items-center justify-between select-none pb-safe-area-inset-bottom h-[72px] sm:h-[80px]">
    
    <!-- Home -->
    @php $active = navIsActive('home'); @endphp
    <a href="{{ route('home') }}" class="relative flex flex-col items-center justify-center h-full flex-1 group">
        <div class="mb-1 flex items-center justify-center px-4 py-1.5 rounded-2xl transition-all duration-300 {{ $active ? 'bg-emerald-100 text-emerald-800' : 'text-stone-500 group-hover:bg-stone-50 group-hover:text-stone-700' }}">
            <svg class="w-6 h-6 sm:w-[26px] sm:h-[26px]" fill="{{ $active ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $active ? '0' : '2' }}" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <span class="text-[11px] sm:text-[12px] tracking-tight transition-all duration-300 {{ $active ? 'font-bold text-emerald-900' : 'font-medium text-stone-500 group-hover:text-stone-700' }}">Home</span>
    </a>

    <!-- Shop (Triggers Mobile Menu) -->
    <button @click="mobileMenuOpen = true" class="relative flex flex-col items-center justify-center h-full flex-1 group">
        <div class="mb-1 flex items-center justify-center px-4 py-1.5 rounded-2xl transition-all duration-300 text-stone-500 group-hover:bg-stone-50 group-hover:text-stone-700">
            <svg class="w-6 h-6 sm:w-[26px] sm:h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
        </div>
        <span class="text-[11px] sm:text-[12px] font-medium tracking-tight text-stone-500 group-hover:text-stone-700 transition-colors">Shop</span>
    </button>

    <!-- Cart  -->
    <button onclick="openCart()" class="relative flex flex-col items-center justify-center h-full flex-1 group">
        <div class="mb-1 relative flex items-center justify-center px-4 py-1.5 rounded-2xl transition-all duration-300 text-stone-500 group-hover:bg-stone-50 group-hover:text-stone-700">
            <svg class="w-6 h-6 sm:w-[26px] sm:h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            @if(session('cart') && count(session('cart')) > 0)
                <span class="absolute top-0 right-1 bg-rose-500 text-white text-[10px] w-4 h-4 sm:w-[18px] sm:h-[18px] rounded-full flex items-center justify-center font-bold ring-2 ring-white z-10">
                    {{ count(session('cart')) }}
                </span>
            @endif
        </div>
        <span class="text-[11px] sm:text-[12px] font-medium tracking-tight text-stone-500 group-hover:text-stone-700 transition-colors">Cart</span>
    </button>

    <!-- Search -->
    @php $active = navIsActive('products.index'); @endphp
    <a href="{{ route('products.index') }}" class="relative flex flex-col items-center justify-center h-full flex-1 group">
        <div class="mb-1 flex items-center justify-center px-4 py-1.5 rounded-2xl transition-all duration-300 {{ $active ? 'bg-emerald-100 text-emerald-800' : 'text-stone-500 group-hover:bg-stone-50 group-hover:text-stone-700' }}">
            <svg class="w-6 h-6 sm:w-[26px] sm:h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $active ? '2.5' : '2' }}" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <span class="text-[11px] sm:text-[12px] tracking-tight transition-all duration-300 {{ $active ? 'font-bold text-emerald-900' : 'font-medium text-stone-500 group-hover:text-stone-700' }}">Search</span>
    </a>

    <!-- Account -->
    @php $active = navIsActive(['orders.index', 'admin.dashboard']); @endphp
    <a href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : route('orders.index')) : route('login') }}" class="relative flex flex-col items-center justify-center h-full flex-1 group">
        <div class="mb-1 flex items-center justify-center px-4 py-1.5 rounded-2xl transition-all duration-300 {{ $active ? 'bg-emerald-100 text-emerald-800' : 'text-stone-500 group-hover:bg-stone-50 group-hover:text-stone-700' }}">
            <svg class="w-6 h-6 sm:w-[26px] sm:h-[26px]" fill="{{ $active ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $active ? '0' : '2' }}" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <span class="text-[11px] sm:text-[12px] tracking-tight transition-all duration-300 {{ $active ? 'font-bold text-emerald-900' : 'font-medium text-stone-500 group-hover:text-stone-700' }}">Account</span>
    </a>

</div>

<style>
    .pb-safe-area-inset-bottom {
        padding-bottom: calc(env(safe-area-inset-bottom));
    }
</style>
