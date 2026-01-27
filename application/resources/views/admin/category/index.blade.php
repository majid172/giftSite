@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Categories</h1>
            <p class="text-base-content/70 mt-1">Manage your product categories and images</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-lg shadow-primary/30 hover:scale-[1.02] transition-transform">
            <span class="icon-[tabler--plus] size-5"></span>
            Add New Category
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div role="alert" class="alert alert-success shadow-lg mb-4">
        <span class="icon-[tabler--check] size-6"></span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Content Card -->
    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-lg">
                    <thead class="bg-base-200/50 text-base-content uppercase text-sm font-bold">
                        <tr>
                            <th class="rounded-tl-xl pl-6">Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th class="text-right rounded-tr-xl pr-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($categories as $category)
                        <tr class="hover group transition-colors duration-200">
                            <td class="pl-6">
                                <div class="avatar transition-transform duration-300 hover:scale-110">
                                    <div class="mask mask-squircle w-16 h-16 bg-base-200">
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="object-cover" />
                                        @else
                                            <div class="flex items-center justify-center w-full h-full text-base-content/30">
                                                <span class="icon-[tabler--photo] size-8"></span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-bold text-lg">{{ $category->name }}</div>
                            </td>
                            <td>
                                <div class="badge badge-ghost font-mono text-xs">{{ $category->slug }}</div>
                            </td>
                            <td>
                                <p class="text-sm text-base-content/70 line-clamp-2 max-w-xs" title="{{ $category->description }}">
                                    {{ $category->description ?: 'No description' }}
                                </p>
                            </td>
                            <td class="text-right pr-6">
                                <div class="join opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-info btn-square join-item tooltip tooltip-top" data-tip="Edit">
                                        <span class="icon-[tabler--pencil] size-4"></span>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline join-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error btn-square join-item tooltip tooltip-top" data-tip="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <span class="icon-[tabler--trash] size-4"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-4 text-base-content/50">
                                    <span class="icon-[tabler--folder-off] size-16"></span>
                                    <h3 class="font-bold text-lg">No categories found</h3>
                                    <p>Get started by adding your first category.</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <span class="icon-[tabler--plus] size-4"></span>
                                        Add Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
