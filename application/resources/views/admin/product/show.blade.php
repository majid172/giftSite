@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Product Details</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
        <span class="icon-[tabler--arrow-left] size-5"></span>
        Back
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Product Image -->
    <div class="card bg-base-100 shadow-xl">
        <figure class="px-6 pt-6">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400?text=No+Image' }}" alt="{{ $product->name }}" class="rounded-xl object-cover w-full aspect-square" />
        </figure>
        <div class="card-body items-center text-center">
             <h2 class="card-title text-2xl">{{ numberFormat($product->price) }}</h2>
             <span class="badge badge-soft {{ $product->stock > 0 ? 'badge-success' : 'badge-error' }}">
                {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
             </span>
        </div>
    </div>

    <!-- Product Details -->
    <div class="card bg-base-100 shadow-xl lg:col-span-2">
        <div class="card-body">
            <h2 class="card-title text-3xl mb-2">{{ $product->name }}</h2>
            <div class="mb-4">
                <span class="badge badge-primary">{{ $product->category->name }}</span>
                <span class="text-sm text-base-content/60 ml-2">Slug: {{ $product->slug }}</span>
            </div>

            <div class="divider"></div>
            
            <h3 class="font-semibold text-lg mb-2">Description</h3>
            <p class="text-base-content/80 whitespace-pre-line">{{ $product->description ?: 'No description available.' }}</p>

            <div class="divider"></div>

            <div class="flex gap-8 text-sm">
                <div>
                    <span class="font-semibold text-base-content/60 block">Created</span>
                    <span>{{ $product->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div>
                    <span class="font-semibold text-base-content/60 block">Last Updated</span>
                    <span>{{ $product->updated_at->format('M d, Y H:i') }}</span>
                </div>
            </div>

             <div class="card-actions justify-end mt-6">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info">
                    <span class="icon-[tabler--pencil] size-5"></span>
                    Edit Product
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
