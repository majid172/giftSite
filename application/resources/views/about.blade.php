@extends('layouts.fullscreen')

@section('title', 'Our Story - ' . get_setting('site_name', config('app.name')) . ' Premium Gifts')

@section('hero')
    <section class="relative w-full bg-emerald-950 overflow-hidden font-sans min-h-[35vh] flex items-center justify-center pt-20 pb-10">
        <!-- Static Background pattern/color -->
        <div class="absolute inset-0 bg-emerald-900/40"></div>
        <div class="absolute top-0 left-0 w-[40%] h-full bg-emerald-800/40 clip-diagonal-left hidden md:block"></div>
        <div class="absolute top-0 right-0 w-[50%] h-full bg-emerald-900/60 clip-diagonal"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center justify-center gap-4 mb-6">
                    <span class="flex h-px w-12 bg-amber-500"></span>
                    <span class="text-amber-400 font-medium tracking-widest text-xs uppercase">The {{ get_setting('site_name', config('app.name')) }} Way</span>
                    <span class="flex h-px w-12 bg-amber-500"></span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-5xl font-serif font-bold text-white leading-tight mb-6">
                    {{ get_setting('about_hero_title_main', 'Crafting') }} <span class="text-amber-300 italic">{{ get_setting('about_hero_title_highlight', 'Connections') }}</span>
                </h1>

                <p class="text-emerald-50/90 text-md md:text-lg leading-relaxed font-light max-w-2xl mx-auto">
                    {{ get_setting('about_hero_subtitle', 'Where every box tells a story of tradition, uncompromising quality, and the timeless art of intentional giving.') }}
                </p>
            </div>
        </div>
        <style>
            .clip-diagonal {
                clip-path: polygon(15% 0, 100% 0, 100% 100%, 0 100%);
            }
            .clip-diagonal-left {
                clip-path: polygon(0 0, 100% 0, 85% 100%, 0 100%);
            }
        </style>
    </section>
@endsection

@section('content')
    <div class="space-y-24 py-16">

        <!-- Our Mission Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 pb-8 pt-8 border-b border-stone-200">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-sm font-bold text-emerald-900 uppercase tracking-widest mb-6">Our Mission</h2>
                <p class="text-2xl md:text-4xl font-serif font-bold text-emerald-950 leading-snug">
                    "{{ get_setting('about_mission_text', 'To elevate human connection through the beauty of artisanal craftsmanship and curated luxury.') }}"
                </p>
            </div>
        </section>

        <!-- The Story Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 lg:pr-10">
                    <h3 class="text-3xl font-serif font-bold text-emerald-950 mb-6 border-b-2 border-amber-500 inline-block pb-2">{{ get_setting('about_origins_title', 'Our Origins') }}</h3>
                    <div class="space-y-6 text-stone-600 leading-relaxed text-lg font-light">
                        {!! get_setting('about_origins_content', '<p>Founded in the heart of artisanal traditions, ' . get_setting('site_name', config('app.name')) . ' was born from a simple observation: in a world of instant gratification, the soul of gifting was being lost. We wanted to bring back the "Grandeur" of the unboxing experience.</p><p>What started as a small workshop curating local tea leaves and hand-blown glass has evolved into a global destination for those who seek more than just a product—they seek a moment of genuine connection.</p><p>Every material we use, from sustainable silk ribbons to hand-carved wooden chests, is selected with a singular focus: to create a tactile legacy that honors both giver and receiver.</p>') !!}
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative w-full h-[500px] rounded-bl-[6rem] rounded-tr-[6rem] overflow-hidden shadow-2xl border border-stone-200">
                        <img src="{{ get_setting('about_banner_image') ? asset(get_setting('about_banner_image')) : 'https://images.unsplash.com/photo-1608834559454-fddd80d49537?q=80&w=687&auto=format&fit=crop' }}"
                            class="absolute inset-0 w-full h-full object-cover"
                            alt="Artisanal Process">
                        <div class="absolute inset-0 bg-emerald-950/10 mix-blend-multiply"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="bg-stone-50 py-20 border-y border-stone-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-emerald-950 mb-4">Core Values</h2>
                    <p class="text-stone-500 max-w-2xl mx-auto">The principles that guide our curation, ethical sourcing, and uncompromising craftsmanship.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <!-- Value 1 -->
                    <div class="bg-white p-10 rounded shadow-sm border border-stone-100 text-center hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-bold text-emerald-950 mb-3">{{ get_setting('about_value_1_title', 'Uncompromising Quality') }}</h4>
                        <p class="text-stone-600 font-light leading-relaxed text-sm">{{ get_setting('about_value_1_text', 'We source only the finest materials, ensuring every gift box is a masterpiece of longevity and beauty.') }}</p>
                    </div>

                    <!-- Value 2 -->
                    <div class="bg-white p-10 rounded shadow-sm border border-stone-100 text-center hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-bold text-emerald-950 mb-3">{{ get_setting('about_value_2_title', 'Ethical Sourcing') }}</h4>
                        <p class="text-stone-600 font-light leading-relaxed text-sm">{{ get_setting('about_value_2_text', 'Our partnerships support small-scale artisans and eco-conscious packaging standards around the globe.') }}</p>
                    </div>

                    <!-- Value 3 -->
                    <div class="bg-white p-10 rounded shadow-sm border border-stone-100 text-center hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-bold text-emerald-950 mb-3">{{ get_setting('about_value_3_title', 'Intentional Giving') }}</h4>
                        <p class="text-stone-600 font-light leading-relaxed text-sm">{{ get_setting('about_value_3_text', 'We design our products to be more than just boxes; they are bridges that facilitate deep human connections.') }}</p>
                    </div>
                </div>
                
                <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto border-t border-stone-200 pt-16">
                    <div class="text-center">
                        <div class="text-4xl font-serif font-bold text-emerald-950 mb-2">100%</div>
                        <div class="text-stone-500 text-sm uppercase tracking-wider font-bold">Handcrafted</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-serif font-bold text-emerald-950 mb-2">50+</div>
                        <div class="text-stone-500 text-sm uppercase tracking-wider font-bold">Artisan Partners</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-serif font-bold text-emerald-950 mb-2">12</div>
                        <div class="text-stone-500 text-sm uppercase tracking-wider font-bold">Quality Stages</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-serif font-bold text-emerald-950 mb-2">∞</div>
                        <div class="text-stone-500 text-sm uppercase tracking-wider font-bold">Memories</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-emerald-950 rounded-2xl p-12 md:p-20 text-center shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-emerald-900/40 clip-diagonal hidden md:block"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-6">
                        Ready to start your <span class="text-amber-400 italic">journey?</span>
                    </h2>
                    <p class="text-emerald-50/80 text-lg mb-10 max-w-xl mx-auto font-light">
                        Explore our curated collections and find the perfect gift box that speaks your heart's language.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('products.index') }}"
                            class="px-8 py-4 bg-amber-500 text-emerald-950 rounded font-bold hover:bg-amber-400 shadow-md transition-colors">
                            View Collections
                        </a>
                        <a href="{{ route('home') }}"
                            class="px-8 py-4 bg-white/5 text-white border border-white/20 rounded font-bold hover:bg-white/10 transition-colors">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection