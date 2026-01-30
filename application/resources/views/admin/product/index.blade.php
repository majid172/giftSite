
@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table">
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
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 0.375rem;" />
                        @else
                            <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                <i class="ti ti-photo"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-main);">{{ $product->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">#{{ $product->id }}</div>
                    </td>
                    <td>
                        <span style="background: #f1f5f9; padding: 2px 8px; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">
                            {{ $product->category ? $product->category->name : 'Uncategorized' }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 500;">${{ number_format($product->price, 2) }}</div>
                    </td>
                    <td>
                        <span style="background: {{ $product->stock > 0 ? '#dcfce7' : '#fee2e2' }}; color: {{ $product->stock > 0 ? '#166534' : '#991b1b' }}; padding: 2px 8px; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">
                            {{ $product->stock }} In Stock
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline btn-icon" style="padding: 4px 8px;" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-icon" style="padding: 4px 8px; color: var(--danger); border-color: var(--danger);" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <div style="color: var(--text-muted); font-size: 0.875rem;">No products found.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
    <div style="padding: 1rem; border-top: 1px solid var(--border-color);">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
