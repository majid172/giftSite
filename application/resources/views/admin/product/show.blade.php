@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Product Details</h1>
            <p class="text-sm text-gray-500 mt-1">View and manage information for <span class="text-primary font-medium">{{ $product->name }}</span></p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">
                <span class="icon-[tabler--arrow-left] size-4"></span>
                Back to List
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                <span class="icon-[tabler--pencil] size-4"></span>
                Edit Product
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Image Gallery -->
        <div class="lg:col-span-12 xl:col-span-12">
           <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
               <!-- Product Images Area -->
               <div class="space-y-4">
                   <!-- Main Image -->
                   <div class="group relative aspect-square overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 shadow-inner">
                       <img id="main-display-image" src="{{ $product->image ? asset($product->image) : 'https://placehold.co/600x600?text=No+Image' }}" 
                            alt="{{ $product->name }}" 
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-105" />
                       
                       @if($product->stock <= 0)
                           <div class="absolute top-4 left-4">
                               <span class="badge badge-error text-white px-4 py-1.5 h-auto font-bold uppercase tracking-wider shadow-lg">Out of Stock</span>
                           </div>
                       @endif
                   </div>

                   <!-- Gallery Thumbnails -->
                   @if($product->images->count() > 0)
                       <div class="grid grid-cols-5 gap-3">
                           <!-- Include main image in gallery thumbnails -->
                           <div class="aspect-square cursor-pointer overflow-hidden rounded-xl border-2 border-primary ring-2 ring-primary ring-offset-2 transition-all hover:opacity-80" 
                                onclick="updateMainImage('{{ asset($product->image) }}', this)">
                               <img src="{{ asset($product->image) }}" class="h-full w-full object-cover" />
                           </div>
                           @foreach($product->images as $galleryImg)
                               <div class="aspect-square cursor-pointer overflow-hidden rounded-xl border-2 border-transparent transition-all hover:border-primary hover:opacity-80" 
                                    onclick="updateMainImage('{{ asset($galleryImg->image_path) }}', this)">
                                   <img src="{{ asset($galleryImg->image_path) }}" class="h-full w-full object-cover" />
                               </div>
                           @endforeach
                       </div>
                   @endif
               </div>

               <!-- Product Quick Info -->
               <div class="flex flex-col justify-between py-2">
                   <div>
                       <div class="flex items-center gap-2 mb-4">
                           <span class="badge badge-soft badge-primary px-3 py-1 font-semibold uppercase text-[10px] tracking-widest">{{ $product->category->name }}</span>
                           <span class="text-gray-400 text-xs">•</span>
                           <span class="text-gray-500 text-xs font-mono">ID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                       </div>

                       <h2 class="text-4xl font-black text-gray-900 mb-2 leading-tight">{{ $product->name }}</h2>
                       <p class="text-gray-500 text-sm mb-6 font-mono">Slug: {{ $product->slug }}</p>

                       <div class="flex items-baseline gap-4 mb-8 bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                           <span class="text-5xl font-black text-primary">${{ number_format($product->price, 2) }}</span>
                           @if($product->stock > 0)
                               <div class="flex flex-col">
                                   <span class="text-green-600 font-bold text-lg flex items-center gap-1">
                                       <span class="icon-[tabler--circle-check-filled] size-5"></span> In Stock
                                   </span>
                                   <span class="text-gray-400 text-xs">{{ $product->stock }} units available</span>
                               </div>
                           @else
                               <span class="text-red-500 font-bold text-lg flex items-center gap-1">
                                   <span class="icon-[tabler--circle-x-filled] size-5"></span> Out of Stock
                               </span>
                           @endif
                       </div>

                       <div class="grid grid-cols-2 gap-4 mb-8">
                           <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                               <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Created At</p>
                               <p class="text-sm font-semibold text-gray-700">{{ $product->created_at->format('M d, Y') }}</p>
                               <p class="text-[10px] text-gray-400">{{ $product->created_at->format('h:i A') }}</p>
                           </div>
                           <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                               <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Last Updated</p>
                               <p class="text-sm font-semibold text-gray-700">{{ $product->updated_at->format('M d, Y') }}</p>
                               <p class="text-[10px] text-gray-400">{{ $product->updated_at->format('h:i A') }}</p>
                           </div>
                       </div>
                   </div>

                   <div class="flex flex-col gap-3">
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error btn-outline w-full gap-2 rounded-xl" onclick="return confirm('Delete this product permanently?')">
                                <span class="icon-[tabler--trash] size-5"></span>
                                Delete This Product
                            </button>
                        </form>
                   </div>
               </div>
           </div>
        </div>

        <!-- Description Section -->
        <div class="lg:col-span-12 bg-white p-8 rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="icon-[tabler--file-description] size-7 text-primary"></span>
                Product Description
            </h3>
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                {!! $product->description ?: '<p class="text-gray-400 italic">No description provided for this product.</p>' !!}
            </div>
        </div>
    </div>
</div>

<script>
    function updateMainImage(src, element) {
        document.getElementById('main-display-image').src = src;
        
        // Update thumbnail borders
        const thumbnails = element.parentElement.children;
        for (let thumb of thumbnails) {
            thumb.classList.remove('border-primary', 'ring-2', 'ring-primary', 'ring-offset-2');
            thumb.classList.add('border-transparent');
        }
        element.classList.add('border-primary', 'ring-2', 'ring-primary', 'ring-offset-2');
        element.classList.remove('border-transparent');
    }
</script>
@endsection
