@extends('layouts.app')

@section('title', 'Product Details - GiftPack')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Image gallery -->
        <div class="flex flex-col-reverse">
            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden sm:aspect-w-2 sm:aspect-h-3">
                 <div class="h-full w-full bg-gray-300 flex items-center justify-center text-gray-500">Product Image</div>
            </div>
        </div>

        <!-- Product info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Premium Gift Box</h1>
            <div class="mt-3">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl text-gray-900">$35.00</p>
            </div>
            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p>A beautiful curated gift box for any occasion.</p>
                </div>
            </div>
            <div class="mt-6">
                 <button type="button" class="max-w-xs flex-1 bg-rose-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-rose-500 sm:w-full">Add to bag</button>
            </div>
        </div>
    </div>
</div>
@endsection
