@extends('layouts.fullscreen')

@section('content')


    <!-- Fixed Premium Sidebar -->


    <!-- Main Content Area -->
    
        <!-- Sticky Header with Backdrop Blur -->
        

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
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="1">
                                <input type="hidden" name="name" value="Grand Heritage Box">
                                <input type="hidden" name="price" value="45.00">
                                <input type="hidden" name="image" value="https://images.unsplash.com/photo-1589902860314-e910697dea18?auto=format&fit=crop&w=800&q=80">
                                
                                <button type="submit" class="absolute bottom-8 right-8 bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-amber-500/30 opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-amber-400 hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </form>
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
                            <!-- Floating Button -->
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="2">
                                <input type="hidden" name="name" value="Matte Gift Tube">
                                <input type="hidden" name="price" value="12.00">
                                <input type="hidden" name="image" value="https://images.unsplash.com/photo-1544787210-22bb1c0fd310?auto=format&fit=crop&w=800&q=80">

                                <button type="submit" class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </form>
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
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="4">
                                <input type="hidden" name="name" value="Ceramic Tea Pot">
                                <input type="hidden" name="price" value="28.00">
                                <input type="hidden" name="image" value="https://images.unsplash.com/photo-1595995574040-058df5d064dd?auto=format&fit=crop&w=800&q=80">

                                <button type="submit" class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </form>
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
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="5">
                                <input type="hidden" name="name" value="Organic Honey Jar">
                                <input type="hidden" name="price" value="18.50">
                                <input type="hidden" name="image" value="https://images.unsplash.com/photo-1598462740942-87002573228a?auto=format&fit=crop&w=800&q=80">

                                <button type="submit" class="absolute bottom-8 right-8 bg-white text-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-emerald-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </form>
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
      
@endsection