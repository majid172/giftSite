<header class="sticky top-0 z-40 bg-[#F5F5F4]/80 backdrop-blur-xl border-b border-stone-200 px-8 py-5">
    <div class="flex items-center justify-between">

        <!-- LEFT: Logo + Navigation -->
        <div class="flex items-center gap-8">
            <!-- <div class="font-serif font-bold text-emerald-900 text-xl">
                Heritage
            </div> -->

            <nav class="hidden md:flex gap-6 text-sm font-semibold text-stone-600">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Home</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">About</a>
                <a href="{{ route('products.index') }}" class="hover:text-emerald-700 transition">Products</a>
            </nav>
        </div>

        <!-- CENTER: Search Bar -->
        <div class="hidden md:block w-[420px]">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400 group-focus-within:text-emerald-600 transition"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                    class="w-full pl-10 pr-4 py-2 rounded-full bg-white text-stone-900 placeholder-stone-400
                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20 shadow-sm"
                    placeholder="Search gift boxes, flowers, chocolates..." />
            </div>
        </div>

        <!-- RIGHT: Auth + Cart -->
        <div class="flex items-center gap-6">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm font-bold text-stone-600 hover:text-emerald-700 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm font-bold text-stone-600 hover:text-emerald-700 transition">
                    Sign In
                </a>
            @endauth

            <button onclick="openCart()"
                class="relative p-2 text-stone-600 hover:text-emerald-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>

                @if(session('cart') && count(session('cart')) > 0)
                    <span
                        class="absolute top-0 right-0 bg-amber-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </button>
        </div>

    </div>
</header>
