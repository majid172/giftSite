@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--category] size-6"></span>
            Categories
        </div>
        <a href="{{ route('admin.categories.create') }}" class="create-btn">
            <span class="icon-[tabler--plus] size-4"></span>
            Add New Category
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="section-card">
        <div class="card-header">
            <span>All Categories</span>
            <span class="text-xs font-normal text-slate-500">Manage your product categories</span>
        </div>
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="custom-table">
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
                                    <img src="{{ asset('assets/images/' . $category->image) }}" alt="{{ $category->name }}" class="table-img" />
                                @else
                                    <div class="table-img flex items-center justify-center text-slate-400">
                                        <span class="icon-[tabler--photo] size-5"></span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ $category->name }}</div>
                            </td>
                            <td>
                                <span class="badge badge-gray">{{ $category->slug }}</span>
                            </td>
                            <td>
                                <p class="text-slate-500 line-clamp-1 max-w-xs">{{ $category->description ?: '-' }}</p>
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="action-btn" title="Edit">
                                        <span class="icon-[tabler--pencil] size-4.5"></span>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
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
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                        <span class="icon-[tabler--folder-off] size-8"></span>
                                    </div>
                                    <div class="text-slate-500 font-medium">No categories found</div>
                                    <p class="text-sm text-slate-400">Get started by creating your first category.</p>
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
