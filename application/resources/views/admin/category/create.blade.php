@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--plus] size-6"></span>
            Add New Category
        </div>
        <a href="{{ route('admin.categories.index') }}" class="back-btn">
            <span class="icon-[tabler--arrow-left] size-4"></span>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="section-card">
            <div class="card-header">Category Details</div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left: Form Fields -->
                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label" for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter category name" required>
                            @error('name')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter category description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right: Image Upload -->
                    <div>
                        <label class="form-label block mb-2">Category Image</label>
                        <div class="image-preview-box" onclick="document.getElementById('image').click()">
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                            <div id="upload-placeholder" class="text-center p-4">
                                <span class="icon-[tabler--photo-plus] size-8 text-slate-400 mb-1"></span>
                                <p class="text-xs text-slate-500 font-medium">Click to upload</p>
                            </div>
                            <img id="image-preview" src="#" alt="Preview" class="image-preview hidden">
                        </div>
                        @error('image')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="save-btn">Create Category</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
