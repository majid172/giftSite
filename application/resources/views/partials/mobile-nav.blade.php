<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-stone-100 z-50 pb-safe shadow-[0_-8px_30px_rgba(0,0,0,0.04)]">
    <div class="flex items-center justify-around h-16">
        <!-- Home -->
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full relative group transition-all duration-300 active:scale-95">
            <svg class="w-6 h-6 {{ request()->routeIs('home') ? 'text-emerald-700' : 'text-stone-400' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-[10px] mt-1 font-bold {{ request()->routeIs('home') ? 'text-emerald-700' : 'text-stone-400' }}">Home</span>
            @if(request()->routeIs('home'))
                <span class="absolute top-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-700 rounded-full"></span>
            @endif
        </a>

        <!-- Shop -->
        <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center w-full h-full relative group transition-all duration-300 active:scale-95">
            <svg class="w-6 h-6 {{ request()->is('products*') ? 'text-emerald-700' : 'text-stone-400' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="text-[10px] mt-1 font-bold {{ request()->is('products*') ? 'text-emerald-700' : 'text-stone-400' }}">Shop</span>
            @if(request()->is('products*'))
                <span class="absolute top-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-700 rounded-full"></span>
            @endif
        </a>

        <!-- Story (About) -->
        <a href="{{ route('about') }}" class="flex flex-col items-center justify-center w-full h-full relative group transition-all duration-300 active:scale-95">
            <svg class="w-6 h-6 {{ request()->routeIs('about') ? 'text-emerald-700' : 'text-stone-400' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="text-[10px] mt-1 font-bold {{ request()->routeIs('about') ? 'text-emerald-700' : 'text-stone-400' }}">Story</span>
            @if(request()->routeIs('about'))
                <span class="absolute top-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-700 rounded-full"></span>
            @endif
        </a>

        <!-- Cart -->
        <button onclick="openCart()" class="flex flex-col items-center justify-center w-full h-full relative transition-all duration-300 active:scale-95">
            <div class="relative">
                <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-amber-500 text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold border-2 border-white">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </div>
            <span class="text-[10px] mt-1 font-bold text-stone-400">Cart</span>
        </button>

        <!-- Menu -->
        <button @click="$dispatch('toggle-mobile-menu')" class="flex flex-col items-center justify-center w-full h-full relative transition-all duration-300 active:scale-95">
            <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            <span class="text-[10px] mt-1 font-bold text-stone-400">Menu</span>
        </button>
    </div>
</div>
