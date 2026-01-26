@extends('layouts.fullscreen')

@section('title', 'Register - Heritage GiftPack')

@section('content')
<div class="min-h-screen flex font-sans text-stone-600">
    
    <!-- Left Side: Image / Brand -->
    <div class="hidden lg:flex w-1/2 bg-emerald-950 relative items-center justify-center p-12 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1513201099705-a9746e1e201f?auto=format&fit=crop&w=1000&q=80" 
             class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" alt="Heritage Register">
        <div class="absolute inset-0 bg-gradient-to-tl from-emerald-950 via-emerald-900/80 to-transparent"></div>
        
        <div class="relative z-10 text-white max-w-lg">
            <div class="mb-6 w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-3xl shadow-lg">H</div>
            <h1 class="text-5xl font-serif font-bold mb-6 leading-tight">Join the <br> <span class="text-amber-400 italic">legacy</span></h1>
            <p class="text-emerald-100 text-lg leading-relaxed">Create an account to unlock exclusive member-only collections, early access to seasonal releases, and personalized gifting services.</p>
        </div>
    </div>

    <!-- Right Side: Register Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 sm:p-12 lg:p-24">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-xl shadow-md mx-auto mb-3">H</div>
                <h2 class="text-2xl font-serif font-bold text-emerald-950">Heritage GiftPack</h2>
            </div>
            
            <div>
                <h2 class="text-3xl font-serif font-bold text-emerald-950 mb-2">Create Account</h2>
                <p class="text-stone-500">Begin your journey with us today.</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-emerald-950 mb-1">Full Name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="John Doe">
                        @error('name')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-emerald-950 mb-1">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-emerald-950 mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="Create a strong password">
                        @error('password')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-emerald-950 mb-1">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="Confirm your password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-emerald-950 hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 uppercase tracking-wider transition-all transform hover:-translate-y-0.5">
                        Register Account
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-stone-500">Already a member?</span>
                <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-900 transition">Sign in</a>
            </div>
        </div>
    </div>
</div>
@endsection
