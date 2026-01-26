@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Edit Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">
        <span class="icon-[tabler--arrow-left] size-5"></span>
        Back
    </a>
</div>

<div class="card bg-base-100 shadow-xl max-w-2xl mx-auto">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-control mb-4">
                <label class="label" for="name">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" id="name" class="input input-bordered w-full @error('name') input-error @enderror" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control mb-6">
                <label class="label" for="description">
                    <span class="label-text">Description</span>
                </label>
                <textarea name="description" id="description" class="textarea textarea-bordered h-24 w-full">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="card-actions justify-end">
                <button type="submit" class="btn btn-primary">
                    <span class="icon-[tabler--device-floppy] size-5"></span>
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
