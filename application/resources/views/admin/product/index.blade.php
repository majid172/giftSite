@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--box] size-6"></span>
            Products
        </div>
        <a href="{{ route('admin.products.create') }}" class="create-btn">
            <span class="icon-[tabler--plus] size-4"></span>
            Add New Product
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="section-card">
        <div class="card-header">
            <span>All Products</span>
            <span class="text-xs font-normal text-slate-500">Manage your store products</span>
        </div>
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th width="80">Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="table-img" />
                                @else
                                    <div class="table-img flex items-center justify-center text-slate-400">
                                        <span class="icon-[tabler--photo] size-5"></span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ $product->name }}</div>
                                <div class="text-xs text-slate-400">#{{ $product->id }}</div>
                            </td>
                            <td>
                                <span class="badge badge-gray">{{ $product->category ? $product->category->name : 'Uncategorized' }}</span>
                            </td>
                            <td>
                                <div class="font-medium text-slate-700">${{ number_format($product->price, 2) }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $product->stock > 0 ? 'badge-green' : 'badge-red' }}">
                                    {{ $product->stock }} In Stock
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn" title="Edit">
                                        <span class="icon-[tabler--pencil] size-4.5"></span>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete" onclick="return confirm('Are you sure?')">
                                            <span class="icon-[tabler--trash] size-4.5"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                        <span class="icon-[tabler--package-off] size-8"></span>
                                    </div>
                                    <div class="text-slate-500 font-medium">No products found</div>
                                    <p class="text-sm text-slate-400">Get started by adding your first product.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
