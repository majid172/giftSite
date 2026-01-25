<header class="bg-white sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-serif font-bold text-gray-900 tracking-wide">
                    GIFT<span class="text-rose-500">PACK</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-rose-500' : 'text-gray-600 hover:text-rose-500' }} transition-colors duration-200 font-medium text-sm uppercase tracking-wider">Home</a>
                <a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'text-rose-500' : 'text-gray-600 hover:text-rose-500' }} transition-colors duration-200 font-medium text-sm uppercase tracking-wider">Shop</a>
                <a href="{{ url('/occasions') }}" class="{{ request()->is('occasions*') ? 'text-rose-500' : 'text-gray-600 hover:text-rose-500' }} transition-colors duration-200 font-medium text-sm uppercase tracking-wider">Occasions</a>
                <a href="{{ url('/about') }}" class="{{ request()->is('about*') ? 'text-rose-500' : 'text-gray-600 hover:text-rose-500' }} transition-colors duration-200 font-medium text-sm uppercase tracking-wider">About</a>
            </nav>

            <!-- Icons -->
            <div class="flex items-center space-x-6">
                <!-- Search -->
                <button class="text-gray-500 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- User -->
                @guest
                    <a href="{{ url('/login') }}" class="text-gray-500 hover:text-rose-500 transition-colors" title="Login">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @else
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center text-gray-500 hover:text-rose-500 transition-colors focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm truncate text-gray-900 font-medium">Hello, User</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                <!-- Cart -->
                <a href="{{ url('/cart') }}" class="relative text-gray-500 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <!-- Badge -->
                    <span class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">
                        2
                    </span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-600' }} block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-600' }} block px-3 py-2 rounded-md text-base font-medium">Shop</a>
            <a href="{{ url('/occasions') }}" class="{{ request()->is('occasions*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-600' }} block px-3 py-2 rounded-md text-base font-medium">Occasions</a>
            <a href="{{ url('/about') }}" class="{{ request()->is('about*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-600' }} block px-3 py-2 rounded-md text-base font-medium">About</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // User Dropdown Toggle
            const userMenuBtn = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');

            if (userMenuBtn && userMenuDropdown) {
                userMenuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userMenuDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!userMenuBtn.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                        userMenuDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</header>
