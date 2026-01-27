@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Edit Category</h1>
            <p class="text-base-content/70 mt-1">Update category details and image</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">
            <span class="icon-[tabler--arrow-left] size-5"></span>
            Back to List
        </a>
    </div>

    <!-- Main Card -->
    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body p-8">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column: Image Upload -->
                    <div class="space-y-4">
                        <label class="label font-bold text-lg">Category Image</label>
                        <div class="aspect-square relative w-full rounded-2xl border-2 border-dashed border-base-content/20 hover:border-primary transition-colors flex flex-col items-center justify-center bg-base-200/30 overflow-hidden group hover:bg-base-200/50 cursor-pointer" onclick="document.getElementById('image').click()">
                            
                            <!-- Existing Image or Upload Placeholder -->
                            @if($category->image)
                                <img id="image-preview" src="{{ asset($category->image) }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover rounded-2xl" />
                                <div id="upload-placeholder" class="hidden text-center p-6 transition-all duration-300">
                                    <span class="icon-[tabler--photo-plus] size-16 text-base-content/30 mb-2"></span>
                                    <p class="font-medium text-base-content/70">Change image</p>
                                </div>
                            @else
                                <div id="upload-placeholder" class="text-center p-6 transition-all duration-300 group-hover:scale-105">
                                    <span class="icon-[tabler--photo-plus] size-16 text-base-content/30 mb-2"></span>
                                    <p class="font-medium text-base-content/70">Click to upload image</p>
                                    <p class="text-sm text-base-content/40 mt-1">SVG, PNG, JPG (MAX. 2MB)</p>
                                </div>
                                <img id="image-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-2xl" />
                            @endif

                            <!-- Hover Overlay for Preview -->
                            <div id="preview-overlay" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity {{ $category->image ? '' : 'hidden' }}">
                                <span class="btn btn-circle btn-sm btn-ghost text-white">
                                    <span class="icon-[tabler--pencil] size-5"></span>
                                </span>
                            </div>
                        </div>
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                        @error('image')
                            <div class="text-error text-sm mt-1 flex items-center gap-1">
                                <span class="icon-[tabler--alert-circle] size-4"></span>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Right Column: Form Fields -->
                    <div class="space-y-6">
                        <div class="form-control w-full">
                            <label class="label font-bold" for="name">Name</label>
                            <input type="text" name="name" id="name" class="input input-bordered w-full h-12 focus:input-primary" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label font-bold" for="description">Description</label>
                            <textarea name="description" id="description" class="textarea textarea-bordered w-full h-32 leading-normal focus:textarea-primary resize-none" placeholder="Briefly describe this category...">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2 pt-4">
                            <button type="submit" class="btn btn-primary btn-block shadow-lg shadow-primary/30 hover:scale-[1.01] transition-transform">
                                <span class="icon-[tabler--device-floppy] size-5"></span>
                                Update Category
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('image-preview');
        const overlay = document.getElementById('preview-overlay');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
                overlay.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
