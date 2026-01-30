
@extends('admin.layouts.app')

@push('css')
<style>
    .form-layout-sm {
        max-width: 800px;
        margin: 0 auto;
    }
    .img-upload-box {
        border: 2px dashed var(--border-color);
        border-radius: var(--radius);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #fff;
    }
    .img-upload-box:hover {
        border-color: var(--primary);
        background: #f8fafc;
    }
    .img-upload-box img {
        max-width: 100%;
        max-height: 180px;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="form-layout-sm">
    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-size: 1.5rem; font-weight: 600;">Add New Category</h2>
            <div style="color: var(--text-muted); font-size: 0.875rem;">Create a new product category</div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <!-- Left: Inputs -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter category name" required>
                        @error('name') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Enter category description... win customers with words">{{ old('description') }}</textarea>
                         @error('description') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Right: Image -->
                <div>
                    <label class="form-label">Category Image</label>
                    <div class="img-upload-box" onclick="document.getElementById('image').click()">
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                        <div id="upload-placeholder">
                            <i class="ti ti-photo-plus" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 10px;"></i>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">Click to upload image</p>
                        </div>
                        <img id="image-preview" src="#" alt="Preview" class="hidden">
                    </div>
                     @error('image') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px; text-align: right;">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-check"></i> Create Category
                </button>
            </div>
        </div>
    </form>
</div>

@push('js')
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
@endpush
@endsection
