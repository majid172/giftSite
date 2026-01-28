@extends('layouts.fullscreen')

@section('title', 'Our Story - Heritage Premium Gifts')

@section('hero')
    <!-- Hero Section -->
    <section class="relative w-full bg-emerald-950 overflow-hidden font-sans">
        <!-- Desktop Image Overlay -->
        <div class="hidden lg:block absolute inset-y-0 right-0 w-1/2">
            <img src="https://images.unsplash.com/photo-1704134932084-e0dc05c8808b?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="w-full h-full object-cover" alt="Heritage Craftsmanship">
            <div class="absolute inset-0 bg-emerald-950/40 mix-blend-multiply"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 min-h-[500px] lg:h-[70vh] items-center">
                <div class="py-20 lg:py-0">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <span class="w-12 h-[1px] bg-amber-500"></span>
                        <span class="text-amber-400 font-bold tracking-[0.2em] text-xs uppercase">The Heritage Way</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-8xl font-serif font-bold text-white leading-tight mb-8">
                        Crafting <br> <span class="text-amber-400 italic">Connections</span>
                    </h1>

                    <p class="text-emerald-100/80 text-xl mb-10 max-w-lg leading-relaxed font-light">
                        Where every box tells a story of tradition, quality, and the art of intentional giving.
                    </p>
                </div>

                <!-- Mobile Image -->
                <div class="lg:hidden h-[300px] w-full relative mb-12 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1704134932084-e0dc05c8808b?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 w-full h-full object-cover" alt="Heritage Craftmanship">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="space-y-32 py-24">
        
        <!-- Our Mission Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-sm font-bold text-amber-600 uppercase tracking-widest mb-4">Our Mission</h2>
                <p class="text-3xl md:text-5xl font-serif font-bold text-emerald-950 leading-snug">
                    "To elevate the human connection through the beauty of artisanal craftsmanship and curated luxury."
                </p>
                <div class="w-24 h-1 bg-amber-500 mx-auto mt-10"></div>
            </div>
        </section>

        <!-- The Story Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-4xl font-serif font-bold text-emerald-950 mb-8 lowercase italic">the genesis...</h3>
                    <div class="space-y-6 text-stone-600 leading-loose text-lg">
                        <p>
                            Founded in the heart of artisanal traditions, Heritage was born from a simple observation: in a world of instant gratification, the soul of gifting was being lost. We wanted to bring back the "Grandeur" of the unboxing experience.
                        </p>
                        <p>
                            What started as a small workshop curating local tea leaves and hand-blown glass has evolved into a global destination for those who seek more than just a product—they seek a moment of genuine heritage.
                        </p>
                        <p>
                            Every material we use, from the sustainable silk ribbons to the hand-carved wooden chests, is selected with a singular focus: to create a tactile legacy that honors both the giver and the receiver.
                        </p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-amber-500/10 rounded-3xl blur-2xl group-hover:bg-amber-500/20 transition duration-500"></div>
                        <img src="https://images.unsplash.com/photo-1608834559454-fddd80d49537?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             class="relative rounded-3xl shadow-2xl w-full h-[500px] object-cover filter contrast-125" 
                             alt="Artisanal Process">
                        <div class="absolute bottom-8 -left-8 bg-white p-8 rounded-2xl shadow-xl max-w-xs border border-stone-100 hidden md:block">
                            <p class="text-emerald-900 font-serif font-bold text-xl mb-2">100% Handcrafted</p>
                            <p class="text-stone-500 text-sm leading-relaxed">Each heritage box undergoes 12 stages of quality curation before it leaves our workshop.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Grid -->
        <section class="bg-emerald-900 py-32 -mx-4 sm:-mx-6 lg:-mx-8">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20 text-white">
                    <h2 class="text-4xl font-serif font-bold mb-4">The Pillars of Heritage</h2>
                    <p class="text-emerald-100/60 max-w-xl mx-auto">Commitments that guide our every selection and partnership.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-[3rem] hover:bg-white/10 transition duration-500 group">
                        <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-amber-500/20 transform group-hover:rotate-6 transition">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-serif font-bold text-white mb-4">Uncompromising Quality</h4>
                        <p class="text-emerald-50/60 leading-relaxed">We source only the finest materials, from AAA-grade tea leaves to sustainably harvested hardwoods.</p>
                    </div>

                    <!-- Value 2 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-[3rem] hover:bg-white/10 transition duration-500 group">
                        <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-emerald-500/20 transform group-hover:rotate-6 transition">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        </div>
                        <h4 class="text-2xl font-serif font-bold text-white mb-4">The Ethical Ribbon</h4>
                        <p class="text-emerald-50/60 leading-relaxed">Gifting should feel good. Our partnerships support small-scale artisans and eco-conscious packaging.</p>
                    </div>

                    <!-- Value 3 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-[3rem] hover:bg-white/10 transition duration-500 group">
                        <div class="w-16 h-16 bg-rose-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-rose-500/20 transform group-hover:rotate-6 transition">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-serif font-bold text-white mb-4">Intentional Giving</h4>
                        <p class="text-emerald-50/60 leading-relaxed">It's not just a box; it's a bridge. We design our products to facilitate deep, lasting human connections.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-stone-100 rounded-[4rem] p-16 text-center border border-stone-200 shadow-inner relative overflow-hidden">
                <div class="absolute top-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl -ml-20 -mt-20"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-emerald-950 mb-8 lowercase tracking-tight">Ready to start your <span class="text-amber-600">journey?</span></h2>
                    <p class="text-stone-500 text-lg mb-12 max-w-xl mx-auto">Explore our curated collections and find the perfect gift box that speaks your heart's language.</p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ route('products.index') }}" class="px-12 py-5 bg-emerald-900 text-white rounded-full font-bold shadow-2xl hover:bg-emerald-800 transition transform hover:-translate-y-1">View Collections</a>
                        <a href="{{ route('home') }}" class="px-12 py-5 bg-white text-emerald-950 border border-stone-200 rounded-full font-bold hover:bg-stone-50 transition transform hover:-translate-y-1 shadow-md">Back to Home</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
