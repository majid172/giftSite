@extends('layouts.app')

@section('title', 'Shopping Cart - GiftPack')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8">Shopping Cart</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 text-center text-gray-500">
        <p>Your cart is currently empty.</p>
        <div class="mt-6">
            <a href="{{ url('/products') }}" class="text-rose-600 hover:text-rose-500 font-medium">Continue Shopping &rarr;</a>
        </div>
    </div>
</div>
@endsection
