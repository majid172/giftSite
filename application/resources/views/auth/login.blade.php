@extends('layouts.fullscreen')

@section('title', 'Login - ' . get_setting('site_name', config('app.name')))

@section('content')
<div class="min-h-screen flex font-sans text-stone-600">
    
    <!-- Left Side: Image / Brand -->
    <div class="hidden lg:flex w-1/2 bg-emerald-950 relative items-center justify-center p-12 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=1000&q=80" 
             class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" alt="{{ get_setting('site_name', config('app.name')) }} Packaging">
        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-950 via-emerald-900/80 to-transparent"></div>
        
        <div class="relative z-10 text-white max-w-lg">
            <div class="mb-6 w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-3xl shadow-lg">H</div>
            <h1 class="text-5xl font-serif font-bold mb-6 leading-tight">Welcome Back to <br> <span class="text-amber-400 italic">{{ get_setting('site_name', config('app.name')) }}</span></h1>
            <p class="text-emerald-100 text-lg leading-relaxed">Sign in to access your curated wishlist, track exclusive orders, and discover new limited-edition artisan boxes.</p>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 sm:p-12 lg:p-24">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Mobile Logo (Visible only on small screens) -->
            <div class="lg:hidden text-center mb-8">
                <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-xl shadow-md mx-auto mb-3">H</div>
                <h2 class="text-2xl font-serif font-bold text-emerald-950">{{ get_setting('site_name', config('app.name')) }}</h2>
            </div>
            
            <div>
                <h2 class="text-3xl font-serif font-bold text-emerald-950 mb-2">Sign In</h2>
                <p class="text-stone-500">Welcome back! Please enter your details.</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-emerald-950 mb-1">Phone Number</label>
                        <input id="phone" name="phone" type="text" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="e.g. 01712345678">
                        @error('phone')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-semibold text-emerald-950">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-500 transition">Forgot password?</a>
                            @endif
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-lg placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-colors sm:text-sm" 
                               placeholder="••••••••">
                         @error('password')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-stone-300 rounded cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-sm text-stone-600 cursor-pointer">Remember me for 30 days</label>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-emerald-950 hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 uppercase tracking-wider transition-all transform hover:-translate-y-0.5">
                        Sign in
                    </button>
                    <!-- <button type="button" class="mt-3 w-full flex justify-center py-3 px-4 border border-stone-200 rounded-lg shadow-sm text-sm font-bold text-stone-700 bg-white hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-200 transition-all">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-2" alt="Google"> Sign in with Google
                    </button> -->
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-stone-500">Don't have an account?</span>
                <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-900 transition">Create an account</a>
            </div>
        </div>
    </div>
</div>
@endsection
