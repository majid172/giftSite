@extends('layouts.fullscreen')

@section('content')
<style>
    /* Custom Color Palette */
    :root {
        --color-primary-dark: #064E3B;  /* Emerald 900 */
        --color-primary: #059669;       /* Emerald 600 */
        --color-accent: #D97706;        /* Amber 600 */
        --color-bg: #F5F5F4;            /* Stone 100 */
    }

    .sidebar-gradient {
        background: linear-gradient(180deg, #064E3B 0%, #065F46 100%);
    }
    
    .sidebar-pattern {
        background-color: #064E3B;
        background-image: 
            linear-gradient(rgba(6, 78, 59, 0.9), rgba(6, 78, 59, 0.95)),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30c0-10 10-20 20-20s10 10 10 20-10 20-20 20-20-10-20-20z' fill='%2310B981' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    .slider-wrapper { display: flex; transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1); }
    .slide { min-width: 100%; transition: opacity 0.5s ease; }
    
    /* Hide scrollbar for clean UI */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="flex min-h-screen bg-[#F5F5F4] overflow-hidden">
    <!-- Fixed Premium Sidebar -->
    <aside class="hidden lg:flex flex-col w-80 sidebar-pattern text-white fixed h-screen z-50 shadow-2xl">
        <div class="p-10 flex flex-col h-full">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-4 mb-16">
                <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-xl shadow-lg shadow-amber-500/20">H</div>
                <div>
                    <h1 class="text-2xl font-serif font-bold tracking-tight text-white leading-none">Heritage</h1>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-amber-400 mt-1">Gifts & Co.</p>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="flex-1 space-y-10">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-6 opacity-90">Collections</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Luxury Gift Boxes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Artisan Tea Sets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Wooden Crates</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-6 opacity-90">Occasions</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Wedding Heritage</a></li>
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Seasonal Harvest</a></li>
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Festive Specials</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Footer Badge -->
            <div class="pt-8 border-t border-emerald-800/50">
                <div class="flex items-start gap-4 opacity-80 hover:opacity-100 transition">
                    <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-wider">Authentic Assurance</p>
                        <p class="text-[10px] text-emerald-200 mt-1">100% Premium Sourced</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 lg:ml-80 relative flex flex-col min-h-screen">
        <!-- Sticky Header with Backdrop Blur -->
        <header class="sticky top-0 z-40 bg-[#F5F5F4]/80 backdrop-blur-xl border-b border-stone-200 px-8 py-5 flex justify-between items-center">
            <!-- Search Bar -->
            <div class="relative group hidden md:block w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-stone-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border-none rounded-full leading-5 bg-white text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:bg-white shadow-sm transition-all" placeholder="Search for gift boxes, tea sets...">
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden p-2 text-stone-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
            <div class="lg:hidden font-serif font-bold text-emerald-900 text-xl">Heritage</div>

            <!-- Right Actions -->
            <div class="flex items-center gap-6">
                 @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-stone-600 hover:text-emerald-700 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-stone-600 hover:text-emerald-700 transition hidden md:block">Sign In</a>
                @endauth

                <div class="h-6 w-px bg-stone-300 hidden md:block"></div>
                
                <a href="{{ route('cart') }}" class="relative p-2 text-stone-600 hover:text-emerald-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute top-0 right-0 bg-amber-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold shadow-sm">2</span>
                </a>
            </div>
        </header>

        <div class="p-6 md:p-10 max-w-7xl mx-auto space-y-20 flex-grow w-full">
            <!-- Hero Slider -->
            <section class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-emerald-900/10 h-[500px] group">
                <div id="slider" class="slider-wrapper h-full">
                    <!-- Slide 1 -->
                    <div class="slide relative bg-emerald-900">
                        <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay" alt="Heritage Packaging">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-transparent"></div>
                        <div class="relative h-full flex flex-col justify-center px-10 md:px-24">
                            <div class="inline-flex items-center gap-2 mb-6">
                                <span class="w-8 h-[2px] bg-amber-500"></span>
                                <span class="text-amber-400 font-bold tracking-[0.2em] text-xs uppercase">Limited Collection</span>
                            </div>
                            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white leading-[1.1] mb-8">
                                Unbox the <br> <span class="text-amber-400 italic">Extraordinary</span>
                            </h1>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="bg-amber-500 hover:bg-amber-400 text-white px-8 py-4 rounded-full font-bold transition-all shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-1">Explore Collection</a>
                                <a href="{{ route('about') }}" class="backdrop-blur-md bg-white/10 border border-white/20 text-white hover:bg-white/20 px-8 py-4 rounded-full font-bold transition-all">Our Story</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 1. Shop By Category -->
            <section>
                 <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-serif font-bold text-emerald-950">Shop by Category</h2>
                    <a href="{{ route('occasions.index') }}" class="text-emerald-700 font-bold text-sm hover:text-emerald-900 transition flex items-center gap-1 group">
                        View all <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Category 1 -->
                    <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                        <img src="https://images.unsplash.com/photo-1605648916361-9bd2a99f947b?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Gift Boxes">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-serif font-bold">Premium Gift Boxes</h3>
                            <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Starting at $45</p>
                        </div>
                    </a>
                     <!-- Category 2 -->
                    <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                        <img src="https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Tea Sets">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-serif font-bold">Artisan Tea Sets</h3>
                            <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Exclusive Blends</p>
                        </div>
                    </a>
                     <!-- Category 3 -->
                    <a href="#" class="group relative rounded-2xl overflow-hidden h-64 shadow-md">
                        <img src="https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Festive">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-serif font-bold">Seasonal Specials</h3>
                            <p class="text-sm text-stone-300 mt-1 group-hover:text-white transition-colors">Limited Time Only</p>
                        </div>
                    </a>
                </div>
            </section>

            <!-- 2. Featured Products -->
            <section>
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                    <div>
                        <h2 class="text-3xl font-serif font-bold text-emerald-950">Featured Products</h2>
                        <p class="text-stone-500 mt-2">Curated selections handpicked for perfection.</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-emerald-700 font-bold hover:text-emerald-900 flex items-center gap-2 group">
                        View All 
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Featured Item 1 -->
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-[2rem] p-4 shadow-sm group-hover:shadow-xl transition-all duration-500 ease-out border border-stone-100 overflow-visible">
                            <div class="absolute -top-3 left-6 z-10">
                                <span class="bg-emerald-900 text-amber-400 text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-lg">Bestseller</span>
                            </div>
                            <div class="rounded-[1.5rem] overflow-hidden bg-stone-50 h-64 relative">
                                <img src="https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Sylhet Collection">
                            </div>
                            <!-- Floating Button -->
                            <button class="absolute bottom-8 right-8 bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-amber-500/30 opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-amber-400 hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <div class="mt-5 pl-2">
                             <h3 class="font-serif font-bold text-xl text-emerald-950 group-hover:text-emerald-700 transition-colors">Grand Heritage Box</h3>
                             <p class="text-stone-500 text-sm mt-1">Sylhet Collection</p>
                             <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-emerald-700">$45.00</span>
                             </div>
                        </div>
                    </div>

                    <!-- Featured Item 2 -->
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-[2rem] p-4 shadow-sm group-hover:shadow-xl transition-all duration-500 ease-out border border-stone-100">
                             <div class="rounded-[1.5rem] overflow-hidden bg-stone-50 h-64 relative">
                                <img src="https://images.unsplash.com/photo-1544787210-22bb1c0fd310?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Matte Green Tube">
                            </div>
                            <button class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                        <div class="mt-5 pl-2">
                             <h3 class="font-serif font-bold text-xl text-emerald-950 group-hover:text-emerald-700 transition-colors">Matte Gift Tube</h3>
                             <p class="text-stone-500 text-sm mt-1">Premium Packaging</p>
                             <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-emerald-700">$12.00</span>
                             </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Promo Section -->
            <section class="relative rounded-[2.5rem] overflow-hidden bg-amber-400 p-10 md:p-20 text-emerald-950">
                <div class="absolute top-0 right-0 w-full h-full opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 30c0-10 10-20 20-20s10 10 10 20-10 20-20 20-20-10-20-20z\' fill=\'%23064E3B\' fill-opacity=\'0.8\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
                    <div class="max-w-xl">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">Corporate Gifting, Elevated</h2>
                        <p class="text-emerald-900/80 text-lg">Impress your clients with our bespoke bulk gifting solutions. Custom branding available for orders over 50 units.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="bg-emerald-900 text-amber-400 px-10 py-4 rounded-full font-bold shadow-xl hover:bg-emerald-800 transition transform hover:-translate-y-1 whitespace-nowrap">
                        Get a Quote
                    </a>
                </div>
            </section>

            <!-- 3. Latest Products -->
            <section class="mb-20">
                 <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-serif font-bold text-emerald-950">Latest Arrivals</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Latest Item 1 -->
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-[2rem] p-4 shadow-sm group-hover:shadow-xl transition-all duration-500 ease-out border border-stone-100">
                             <div class="rounded-[1.5rem] overflow-hidden bg-stone-50 h-64 relative">
                                <img src="https://images.unsplash.com/photo-1595995574040-058df5d064dd?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="New Item">
                                <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-emerald-900 text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wide">New</span>
                            </div>
                            <button class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                        <div class="mt-5 pl-2">
                             <h3 class="font-serif font-bold text-xl text-emerald-950 group-hover:text-emerald-700 transition-colors">Ceramic Tea Pot</h3>
                             <p class="text-stone-500 text-sm mt-1">Homeware</p>
                             <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-emerald-700">$28.00</span>
                             </div>
                        </div>
                    </div>
                    <!-- Latest Item 2 -->
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-[2rem] p-4 shadow-sm group-hover:shadow-xl transition-all duration-500 ease-out border border-stone-100">
                             <div class="rounded-[1.5rem] overflow-hidden bg-stone-50 h-64 relative">
                                <img src="https://images.unsplash.com/photo-1598462740942-87002573228a?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Honey Jar">
                            </div>
                            <button class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                        <div class="mt-5 pl-2">
                             <h3 class="font-serif font-bold text-xl text-emerald-950 group-hover:text-emerald-700 transition-colors">Organic Honey</h3>
                             <p class="text-stone-500 text-sm mt-1">Pantry</p>
                             <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-emerald-700">$18.50</span>
                             </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <!-- Footer -->
        @include('partials.footer')
    </main>
</div>
@endsection