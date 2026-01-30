@extends('layouts.app')

@section('title', $title ?? 'Error')

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center -mt-16 px-4 text-center">
    <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-stone-200 max-w-lg w-full">
        <!-- Error Code -->
        <h1 class="font-serif text-6xl md:text-8xl font-bold text-stone-200 mb-4 tracking-tighter">
            @yield('code')
        </h1>

        <!-- Illustration / Icon Placeholder (Optional) -->
        <div class="mb-6 text-emerald-600">
             @yield('icon')
        </div>
        
        <!-- Message -->
        <h2 class="font-serif text-3xl font-bold text-stone-800 mb-4">
            @yield('message')
        </h2>
        
        <p class="text-stone-500 mb-8 max-w-sm mx-auto">
            @yield('description', "Something went wrong. Please check back later or return to the homepage.")
        </p>

        <!-- Actions -->
        <div>
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                Back to Home
            </a>
            @yield('actions')
        </div>
    </div>
</div>
@endsection
