@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Category Details</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">
        <span class="icon-[tabler--arrow-left] size-5"></span>
        Back
    </a>
</div>

<div class="card bg-base-100 shadow-xl max-w-2xl mx-auto">
    <div class="card-body">
        <div class="flex flex-col gap-4">
            <div>
                <h3 class="font-semibold text-lg">Category Name</h3>
                <p class="text-base-content/80">{{ $category->name }}</p>
            </div>
            
            <div class="divider my-0"></div>
            
            <div>
                <h3 class="font-semibold text-lg">Description</h3>
                <p class="text-base-content/80">{{ $category->description ?: 'No description provided.' }}</p>
            </div>

            <div class="divider my-0"></div>

            <div class="flex gap-8">
                <div>
                    <h3 class="font-semibold text-sm text-base-content/60">Created At</h3>
                    <p class="text-sm">{{ $category->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-base-content/60">Last Updated</h3>
                    <p class="text-sm">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="card-actions justify-end mt-6">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info">
                <span class="icon-[tabler--pencil] size-5"></span>
                Edit Category
            </a>
        </div>
    </div>
</div>
@endsection
