@extends('layouts.app')

@section('title', 'Shop - GiftPack')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8">Our Products</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Placeholder Products -->
        @for ($i = 1; $i <= 8; $i++)
        <div class="group relative">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                <div class="h-full w-full bg-gray-300 flex items-center justify-center text-gray-500">Product Image {{ $i }}</div>
            </div>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-700">
                        <a href="{{ url('/product/' . $i) }}">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            Premium Gift Box {{ $i }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Curated Collection</p>
                </div>
                <p class="text-sm font-medium text-gray-900">$35.00</p>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
