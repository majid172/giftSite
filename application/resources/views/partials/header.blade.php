<header class="bg-white sticky top-0 z-40 shadow-sm font-sans" x-data="{ mobileMenuOpen: false }">

    <!-- ROW 1: Main Header (Logo, Search, Icons) -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-8">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
            <div
                class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-lg shadow-md">
                {{ substr(get_setting('site_name', config('app.name')), 0, 1) }}</div>
            <span
                class="text-2xl font-serif font-bold text-emerald-950 tracking-tight">{{ get_setting('site_name', config('app.name')) }}</span>
        </a>

        <!-- Search Bar (Center) -->
        <div class="hidden lg:flex flex-1 max-w-2xl">
            <div
                class="flex w-full bg-stone-100 rounded-full border border-stone-200 focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-500 transition-all overflow-hidden">
                <!-- Category Select -->
                <div class="relative border-r border-stone-200">
                    <select
                        class="appearance-none bg-transparent pl-4 pr-8 py-3 text-sm font-medium text-stone-600 focus:outline-none cursor-pointer h-full hover:text-emerald-700">
                        <option>All Categories</option>
                        <option>Gift Boxes</option>
                        <option>Tea Sets</option>
                        <option>Packaging</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-stone-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Input -->
                <input type="text"
                    class="flex-1 bg-transparent px-4 py-3 text-sm text-stone-900 placeholder-stone-400 focus:outline-none border-none ring-0 w-full"
                    placeholder="Search for products...">

                <!-- Search Button -->
                <button
                    class="bg-amber-500 hover:bg-amber-600 text-white px-6 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-6 flex-shrink-0">

            <!-- User -->
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('orders.index') }}"
                    class="group flex flex-col items-center" title="Dashboard">
                    <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h6v8h-6zM4 16h6v4h-6zM14 12h6v8h-6zM14 4h6v4h-6z"></path>
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex flex-col items-center" title="Logout">
                        <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>
            @endauth

            <!-- Wishlist (Static) -->
           

            <!-- Cart -->
            <button onclick="openCart()" class="relative group">
                <svg class="w-7 h-7 text-stone-600 group-hover:text-emerald-700 transition" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                @if(session('cart') && count(session('cart')) > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-amber-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </button> 
            
            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-stone-600" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- ROW 2: Navigation Bar (Desktop) -->
    <div class="hidden lg:block border-t border-stone-200 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-10">

            <!-- Shop By Categories Dropdown -->
            <div class="relative group py-4">
                <button
                    class="flex items-center gap-3 text-emerald-950 font-bold uppercase tracking-wide hover:text-emerald-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    Shop By Categories
                </button>

                <!-- Hover Menu -->
                <div
                    class="absolute top-full left-0 w-64 bg-white shadow-2xl rounded-b-xl border border-stone-100 hidden group-hover:block z-50 animate-in fade-in slide-in-from-top-2 duration-200">
                    <ul class="py-2">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach($categories as $category)
                            <li><a href="{{ route('products.index', ['category' => $category->id]) }}"
                                    class="block px-6 py-3 text-stone-600 hover:bg-stone-50 hover:text-emerald-700 font-medium transition border-b border-stone-50">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Nav Links -->
            <nav
                class="flex items-center gap-8 text-sm font-bold uppercase tracking-wider text-stone-600 ml-auto">
                <a href="{{ route('home') }}"
                    class="hover:text-amber-500 transition {{ request()->routeIs('home') ? 'text-amber-500' : '' }}">Home</a>

                <a href="{{ route('products.index') }}" class="hover:text-amber-500 transition">Products <span
                        class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded ml-1">HOT</span></a>
                <!-- <a href="{{ route('occasions.index') }}" class="hover:text-amber-500 transition {{ request()->routeIs('occasions.*') ? 'text-amber-500' : '' }}">Occasions</a> -->
                <a href="{{ route('about') }}"
                    class="hover:text-amber-500 transition {{ request()->routeIs('about') ? 'text-amber-500' : '' }}">About</a>
            </nav>

        </div>
    </div>

    <!-- Mobile Menu Drawer -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-full"
         class="fixed inset-0 z-50 bg-white lg:hidden overflow-y-auto flex flex-col"
         style="display: none;">
        
        <!-- Drawer Header -->
        <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-stone-50">
            <span class="text-xl font-serif font-bold text-emerald-950 flex items-center gap-2">
                <span class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-emerald-900 text-sm shadow-sm">
                    {{ substr(get_setting('site_name', config('app.name')), 0, 1) }}
                </span>
                Menu
            </span>
            <button @click="mobileMenuOpen = false" class="text-stone-400 hover:text-rose-500 transition p-2 bg-white rounded-full shadow-sm hover:shadow-md border border-stone-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-6 flex flex-col h-full overflow-y-auto">
            
            <!-- User Section -->
            <div class="mb-8 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                @auth
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-emerald-200 rounded-full flex items-center justify-center text-emerald-800 font-bold text-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-emerald-600 font-medium">Welcome back,</p>
                            <p class="font-bold text-emerald-950 truncate">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('orders.index') }}" class="text-center py-2 px-3 bg-white text-emerald-700 text-sm font-bold rounded-lg border border-emerald-100 hover:bg-emerald-600 hover:text-white transition shadow-sm">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center py-2 px-3 bg-rose-50 text-rose-600 text-sm font-bold rounded-lg border border-rose-100 hover:bg-rose-500 hover:text-white transition shadow-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                <!-- @else
                    <div class="text-center">
                        <p class="text-emerald-800 font-medium mb-3">Welcome to {{ get_setting('site_name', config('app.name')) }}</p>
                        <div class="flex gap-3">
                            <a href="{{ route('login') }}" class="flex-1 py-2 bg-emerald-600 text-white font-bold rounded-lg text-sm hover:bg-emerald-700 transition shadow-sm">Login</a>
                            <a href="{{ route('register') }}" class="flex-1 py-2 bg-white text-emerald-600 border border-emerald-200 font-bold rounded-lg text-sm hover:bg-emerald-50 transition shadow-sm">Register</a>
                        </div>
                    </div> -->
                @endauth
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col gap-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-stone-600 font-bold hover:bg-stone-50 hover:text-emerald-700 transition {{ request()->routeIs('home') ? 'bg-stone-50 text-emerald-700' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('home') ? 'text-amber-500' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg text-stone-600 font-bold hover:bg-stone-50 hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Products
                    </span>
                    <span class="bg-rose-500 text-white text-[10px] uppercase font-black px-2 py-0.5 rounded-full tracking-wider">Hot</span>
                </a>
                <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-stone-600 font-bold hover:bg-stone-50 hover:text-emerald-700 transition {{ request()->routeIs('about') ? 'bg-stone-50 text-emerald-700' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('about') ? 'text-amber-500' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    About Us
                </a>
                
                <!-- Collapsible Categories -->
                <div x-data="{ openCat: false }" class="mt-2">
                    <button @click="openCat = !openCat" class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-stone-600 font-bold hover:bg-stone-50 hover:text-emerald-700 transition">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            Shop By Categories 
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-300" :class="{'rotate-180': openCat}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openCat" x-collapse class="pl-4 pr-2 py-2 space-y-1">
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block px-4 py-2 text-sm text-stone-500 font-medium hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition relative">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-stone-300"></span>
                            <span class="pl-4">{{ $category->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </nav>

            <!-- Search (Mobile) -->
            <div class="mt-8 mb-4">
                 <div
                class="flex w-full bg-stone-50 rounded-xl border border-stone-200 focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-500 transition-all overflow-hidden shadow-sm">
                <input type="text"
                    class="flex-1 bg-transparent px-4 py-3.5 text-sm text-stone-900 placeholder-stone-400 focus:outline-none border-none ring-0 w-full"
                    placeholder="Search for products...">
                <button
                    class="bg-amber-500 hover:bg-amber-600 text-white px-5 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
            </div>
        </div>

        <!-- Footer Contact Info -->
        <div class="mt-auto bg-stone-50 p-6 border-t border-stone-100">
            <div class="flex flex-col gap-3 text-sm text-stone-500">
                <a href="tel:{{ get_setting('contact_phone', '01312617206') }}" class="flex items-center gap-3 hover:text-emerald-700 transition">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm border border-stone-100 text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <span>{{ get_setting('contact_phone', '01312617206') }}</span>
                </a>
                <a href="mailto:{{ get_setting('contact_email', 'mytea@gmail.com') }}" class="flex items-center gap-3 hover:text-emerald-700 transition">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm border border-stone-100 text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span>{{ get_setting('contact_email', 'mytea@gmail.com') }}</span>
                </a>
            </div>
        </div>
    </div>

</header>