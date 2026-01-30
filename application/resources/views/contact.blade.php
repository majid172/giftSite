@extends('layouts.fullscreen')

@section('title', 'Contact Us - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="bg-stone-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-emerald-950 text-white relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1974" 
                 alt="Contact {{ get_setting('site_name', config('app.name')) }}" 
                 class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/50 to-emerald-950"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <span class="text-amber-500 font-bold tracking-[0.2em] text-xs uppercase mb-4 block">We'd love to hear from you</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold mb-6">Get in Touch</h1>
            <p class="text-emerald-100/80 text-lg max-w-2xl mx-auto leading-relaxed">
                Whether you have a question about our bespoke gift boxes, custom corporate orders, or just want to say hello, the {{ get_setting('site_name', config('app.name')) }} team is here for you.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Contact Info Cards -->
            <div class="space-y-6">
                <!-- Email -->
                <div class="bg-white rounded-2xl p-8 shadow-xl shadow-stone-200/50 border border-stone-100 flex items-start gap-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-bold text-emerald-950 text-xl mb-1">Email Us</h3>
                        <p class="text-stone-500 text-sm mb-3">For general inquiries & support</p>
                        <a href="mailto:{{ get_setting('contact_email', 'hello@' . strtolower(config('app.name')) . '.com') }}" class="text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
                            {{ get_setting('contact_email', 'hello@' . strtolower(config('app.name')) . '.com') }}
                        </a>
                    </div>
                </div>

                <!-- Phone -->
                <div class="bg-white rounded-2xl p-8 shadow-xl shadow-stone-200/50 border border-stone-100 flex items-start gap-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-bold text-emerald-950 text-xl mb-1">Call Us</h3>
                        <p class="text-stone-500 text-sm mb-3">Mon-Fri from 9am to 6pm</p>
                        <a href="tel:{{ get_setting('contact_phone', '+1 (555) 123-4567') }}" class="text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
                            {{ get_setting('contact_phone', '+1 (555) 123-4567') }}
                        </a>
                    </div>
                </div>

                <!-- Office -->
                <div class="bg-white rounded-2xl p-8 shadow-xl shadow-stone-200/50 border border-stone-100 flex items-start gap-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-serif font-bold text-emerald-950 text-xl mb-1">Visit Us</h3>
                        <p class="text-stone-500 text-sm mb-3">Our flagship boutique</p>
                        <p class="text-emerald-950 font-medium leading-relaxed">
                            {{ get_setting('contact_address', '123 Artisan Avenue') }}<br>
                            Design District, NY 10012
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 md:p-12 shadow-2xl shadow-stone-200/50 border border-stone-200">
                <h2 class="text-3xl font-serif font-bold text-emerald-950 mb-8">Send us a Message</h2>
                
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-900 px-4 py-3 rounded-xl relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-stone-500">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full bg-stone-50 border @error('first_name') border-red-500 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full bg-stone-50 border @error('last_name') border-red-500 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-stone-50 border @error('email') border-red-500 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Subject</label>
                        <select name="subject" class="w-full bg-stone-50 border @error('subject') border-red-500 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                            <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="Order Status" {{ old('subject') == 'Order Status' ? 'selected' : '' }}>Order Status</option>
                            <option value="Corporate Gifts" {{ old('subject') == 'Corporate Gifts' ? 'selected' : '' }}>Corporate Gifts</option>
                            <option value="Custom Request" {{ old('subject') == 'Custom Request' ? 'selected' : '' }}>Custom Request</option>
                            <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        </select>
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-stone-500">Message</label>
                        <textarea name="message" rows="5" class="w-full bg-stone-50 border @error('message') border-red-500 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-emerald-950 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="bg-emerald-900 hover:bg-emerald-950 text-white font-bold py-4 px-10 rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.98] transition-all duration-200 tracking-wider">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
