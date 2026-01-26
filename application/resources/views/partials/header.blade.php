<header class="bg-white sticky top-0 z-40 shadow-sm font-sans">
    
    <!-- ROW 1: Main Header (Logo, Search, Icons) -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-8">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
            <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-lg shadow-md">H</div>
            <span class="text-2xl font-serif font-bold text-emerald-950 tracking-tight">HERITAGE</span>
        </a>

        <!-- Search Bar (Center) -->
        <div class="hidden lg:flex flex-1 max-w-2xl">
            <div class="flex w-full bg-stone-100 rounded-full border border-stone-200 focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-500 transition-all overflow-hidden">
                <!-- Category Select -->
                <div class="relative border-r border-stone-200">
                    <select class="appearance-none bg-transparent pl-4 pr-8 py-3 text-sm font-medium text-stone-600 focus:outline-none cursor-pointer h-full hover:text-emerald-700">
                        <option>All Categories</option>
                        <option>Gift Boxes</option>
                        <option>Tea Sets</option>
                        <option>Packaging</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-stone-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                
                <!-- Input -->
                <input type="text" 
                    class="flex-1 bg-transparent px-4 py-3 text-sm text-stone-900 placeholder-stone-400 focus:outline-none border-none ring-0 w-full"
                    placeholder="Search for products...">
                
                <!-- Search Button -->
                <button class="bg-amber-500 hover:bg-amber-600 text-white px-6 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-6 flex-shrink-0">
            <!-- Call -->
            <div class="hidden xl:flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center text-stone-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-stone-500 font-medium">Call Now:</p>
                    <p class="text-sm font-bold text-emerald-950">9876-543-210</p>
                </div>
            </div>

            <div class="h-8 w-px bg-stone-200 hidden xl:block"></div>

            <!-- User -->
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex flex-col items-center">
                    <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="group flex flex-col items-center">
                <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </a>
            @endauth

            <!-- Wishlist (Static) -->
            <button class="relative group">
                <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
            </button>

            <!-- Cart -->
            <button onclick="openCart()" class="relative group">
                <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                @if(session('cart') && count(session('cart')) > 0)
                <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                    {{ count(session('cart')) }}
                </span>
                @endif
            </button> <!-- Mobile Menu Button -->
            <button class="lg:hidden text-stone-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>

    <!-- ROW 2: Navigation Bar -->
    <div class="border-t border-stone-200 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-10">
            
            <!-- Shop By Categories Dropdown -->
            <div class="relative group py-4">
                <button class="flex items-center gap-3 text-emerald-950 font-bold uppercase tracking-wide hover:text-emerald-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    Shop By Categories
                </button>
                
                <!-- Hover Menu -->
                <div class="absolute top-full left-0 w-64 bg-white shadow-2xl rounded-b-xl border border-stone-100 hidden group-hover:block z-50 animate-in fade-in slide-in-from-top-2 duration-200">
                    <ul class="py-2">
                        <li><a href="#" class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition border-b border-stone-50">Luxury Gift Boxes</a></li>
                        <li><a href="#" class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition border-b border-stone-50">Artisan Tea Sets</a></li>
                        <li><a href="#" class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition border-b border-stone-50">Handcrafted Packaging</a></li>
                        <li><a href="#" class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition border-b border-stone-50">Seasonal Specials</a></li>
                        <li><a href="#" class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition">Accessories</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Nav Links -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-bold uppercase tracking-wider text-stone-600 ml-auto">
                <a href="{{ route('home') }}" class="hover:text-amber-500 transition {{ request()->routeIs('home') ? 'text-amber-500' : '' }}">Home</a>
              
                <a href="{{ route('products.index') }}" class="hover:text-amber-500 transition">Products <span class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded ml-1">HOT</span></a>
                <!-- <a href="{{ route('occasions.index') }}" class="hover:text-amber-500 transition {{ request()->routeIs('occasions.*') ? 'text-amber-500' : '' }}">Occasions</a> -->
                <a href="{{ route('about') }}" class="hover:text-amber-500 transition {{ request()->routeIs('about') ? 'text-amber-500' : '' }}">About</a>
            </nav>

        </div>
    </div>
</header>
