@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <span class="icon-[tabler--plus] size-5"></span>
        Add New Product
    </a>
</div>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="hover">
                    <td>
                        <div class="avatar">
                            <div class="w-12 h-12 mask mask-squircle">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/100?text=No+Image' }}" alt="{{ $product->name }}" />
                            </div>
                        </div>
                    </td>
                    <td class="font-medium">{{ $product->name }}</td>
                    <td><span class="badge badge-soft badge-primary">{{ $product->category->name }}</span></td>
                    <td>{{ numberFormat($product->price) }}</td>
                    <td>
                         @if($product->stock > 0)
                            <span class="badge badge-success">{{ $product->stock }}</span>
                        @else
                            <span class="badge badge-error">Out of Stock</span>
                        @endif
                    </td>
                    <td class="flex gap-2">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-ghost btn-circle" aria-label="View">
                            <span class="icon-[tabler--eye] size-5"></span>
                        </a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info btn-circle" aria-label="Edit">
                            <span class="icon-[tabler--pencil] size-5"></span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error btn-circle" onclick="return confirm('Are you sure you want to delete this product?')" aria-label="Delete">
                                <span class="icon-[tabler--trash] size-5"></span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-base-content/70">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
