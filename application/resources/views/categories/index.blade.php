@extends('layouts.fullscreen')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 font-sans">
    <div class="mb-10 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-emerald-950 mb-4">All Categories</h1>
        <p class="text-stone-500 max-w-2xl mx-auto">Explore our diverse collection of premium gifts, curated for every occasion.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group relative rounded-2xl overflow-hidden h-72 shadow-lg hover:shadow-2xl transition-all duration-500">
            <img src="{{ asset('assets/images/'.$category->image) }}"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                alt="{{ $category->name }}">
            
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-950/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            
            <div class="absolute bottom-0 left-0 p-8 text-white w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="text-2xl font-serif font-bold mb-2">{{ $category->name }}</h3>
                <p class="text-emerald-100/80 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                    {{ $category->description }}
                </p>
                <span class="inline-flex items-center text-amber-400 font-bold text-xs uppercase tracking-widest gap-2">
                    Explore Collection
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </span>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
