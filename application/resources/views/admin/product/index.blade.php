@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <span class="icon-[tabler--plus] size-5"></span>
            Create Product
        </a>
    </div>


    <div class="card bg-base-100 shadow-xl">
        <div class="card-body overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>

                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="hover:bg-base-200/50 transition-colors">
                            <td>
                                <div class="flex items-center gap-4">
                                    <div class="avatar">
                                        <div class="h-11 w-11 rounded-full ring-2 ring-base-200 ring-offset-1">
                                            <img src="{{ $product->image ? asset($product->image) : 'https://placehold.co/100x100?text=Product' }}"
                                                alt="{{ $product->name }}" class="object-cover" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-base-content">{{ $product->name }}</div>
                                        <div class="text-xs text-base-content/50">Product ID: #{{ $product->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-base-content/70">
                                <span class="font-medium">{{ $product->category->name }}</span>
                            </td>



                            <td>
                                {{ $product->price }}
                            </td>

                            <td>
                                <span class="badge badge-soft badge-{{ $product->stock > 0 ? 'success' : 'danger'}} text-xs">{{ $product->stock }}</span>
                            </td>

                            <td>
                                <div class="flex gap-1 justify-end">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-ghost btn-sm btn-square">
                                        <span class="icon-[tabler--pencil] size-5"></span>
                                    </a>
                                    <button class="btn btn-ghost btn-sm btn-square text-error">
                                        <span class="icon-[tabler--trash] size-5"></span>
                                    </button>
                                </div>
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
