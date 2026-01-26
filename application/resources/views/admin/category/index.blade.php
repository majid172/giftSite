@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <span class="icon-[tabler--plus] size-5"></span>
        Add New Category
    </a>
</div>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="hover">
                    <td>{{ $category->id }}</td>
                    <td class="font-medium">{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-ghost btn-circle" aria-label="View">
                            <span class="icon-[tabler--eye] size-5"></span>
                        </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-info btn-circle" aria-label="Edit">
                            <span class="icon-[tabler--pencil] size-5"></span>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error btn-circle" onclick="return confirm('Are you sure you want to delete this category?')" aria-label="Delete">
                                <span class="icon-[tabler--trash] size-5"></span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-base-content/70">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
