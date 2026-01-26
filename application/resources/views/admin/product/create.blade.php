@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">Add Product</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
        <span class="icon-[tabler--arrow-left] size-5"></span>
        Back
    </a>
</div>

<div class="card bg-base-100 shadow-xl max-w-4xl mx-auto">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text">Product Name</span>
                    </label>
                    <input type="text" name="name" id="name" class="input input-bordered w-full @error('name') input-error @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div class="form-control">
                    <label class="label" for="category_id">
                        <span class="label-text">Category</span>
                    </label>
                    <select name="category_id" id="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                        <option disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Price -->
                <div class="form-control">
                    <label class="label" for="price">
                        <span class="label-text">Price</span>
                    </label>
                    <input type="number" step="0.01" name="price" id="price" class="input input-bordered w-full @error('price') input-error @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="form-control">
                    <label class="label" for="stock">
                        <span class="label-text">Stock</span>
                    </label>
                    <input type="number" name="stock" id="stock" class="input input-bordered w-full @error('stock') input-error @enderror" value="{{ old('stock') }}" required>
                    @error('stock')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                 <div class="form-control">
                    <label class="label" for="image">
                        <span class="label-text">Product Image</span>
                    </label>
                    <input type="file" name="image" id="image" class="file-input file-input-bordered w-full @error('image') file-input-error @enderror">
                    @error('image')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-control col-span-full">
                    <label class="label" for="description">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea name="description" id="description" class="textarea textarea-bordered h-24 w-full" placeholder="Product details...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-actions justify-end mt-6">
                <button type="submit" class="btn btn-primary">
                    <span class="icon-[tabler--check] size-5"></span>
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
