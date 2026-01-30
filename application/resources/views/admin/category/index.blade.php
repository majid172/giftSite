
@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Add New Category
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
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('assets/images/' . $category->image) }}" alt="{{ $category->name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 0.375rem;" />
                        @else
                            <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                <i class="ti ti-category"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-main);">{{ $category->name }}</div>
                    </td>
                    <td>
                         <span style="font-family: monospace; font-size: 0.8em; background: #f1f5f9; padding: 2px 4px; border-radius: 4px;">{{ $category->slug }}</span>
                    </td>
                    <td>
                        <div style="font-size: 0.875rem; color: var(--text-muted); max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $category->description ?? '-' }}
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline btn-icon" style="padding: 4px 8px;" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
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
                    <td colspan="5" style="text-align: center; padding: 3rem;">
                        <div style="color: var(--text-muted); font-size: 0.875rem;">No categories found.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
