
@extends('admin.layouts.app')

@push('css')
<style>
    /* Specific Page Styles */
    .form-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    .form-layout .main-col {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .form-layout .side-col {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    @media(max-width: 992px) {
        .form-layout {
            grid-template-columns: 1fr;
        }
    }
    .img-upload-box {
        border: 2px dashed var(--border-color);
        border-radius: var(--radius);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .img-upload-box:hover {
        border-color: var(--primary);
        background: #f8fafc;
    }
    .img-upload-box img {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
        margin-bottom: 10px;
    }
    .upload-hint {
        color: var(--text-muted);
        font-size: 0.8rem;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 10px;
        margin-top: 15px;
    }
    .gallery-item {
        position: relative;
        border-radius: var(--radius);
        overflow: hidden;
        aspect-ratio: 1;
        border: 1px solid var(--border-color);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .gallery-item .delete-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(255,255,255,0.9);
        color: var(--danger);
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600;">Create New Product</h2>
        <div style="color: var(--text-muted); font-size: 0.875rem;">Add a new product to your catalog</div>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
        <i class="ti ti-arrow-left"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-layout">
        <div class="main-col">
            <!-- General Info -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">General Information</h3>
                
                <div class="form-group">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Luxury Gift Box" required>
                    @error('name') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="0" required>
                         @error('stock') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" placeholder="0.00" required>
                        @error('price') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Old Price ($)</label>
                        <input type="number" step="0.01" name="old_price" class="form-control" value="{{ old('old_price') }}" placeholder="0.00">
                    </div>
                </div>

                <!-- Featured Switch -->
                <div class="flex items-center justify-between p-4 bg-stone-50 rounded-xl border border-stone-100 mb-4">
                    <div>
                        <h4 class="text-sm font-semibold text-stone-700">Featured Product</h4>
                        <p class="text-xs text-stone-500 mt-0.5">Display in "Featured Products" section</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-stone-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <div id="editor" style="height: 200px; background: white; border-radius: var(--radius); border: 1px solid var(--border-color);">{!! old('description') !!}</div>
                    <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                </div>
            </div>

            <!-- Gallery Preview -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px;">Gallery Preview</h3>
                <div class="gallery-grid" id="gallery-preview"></div>
                <div id="no-gallery-msg" style="text-align: center; color: var(--text-muted); padding: 20px;">No gallery images selected.</div>
            </div>

            <!-- Badges -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Product Badge</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Badge Text</label>
                        <input type="text" name="badge" class="form-control" value="{{ old('badge') }}" placeholder="e.g. NEW">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Badge Color</label>
                         <input type="text" name="badge_color" class="form-control" value="{{ old('badge_color') }}" placeholder="e.g. bg-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <div class="side-col">
            <!-- Main Image -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 15px;">Primary Image <span class="text-danger">*</span></h3>
                <div class="img-upload-box" onclick="document.getElementById('image').click()">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewPrimary(this)" required>
                    <div id="upload-placeholder">
                        <i class="ti ti-photo-plus" style="font-size: 2rem; color: var(--text-muted);"></i>
                        <p class="upload-hint">Click to upload</p>
                    </div>
                    <img id="primary-preview" src="#" alt="Preview" class="hidden">
                </div>
                @error('image') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                <p class="upload-hint" style="margin-top: 10px; text-align: center;">Click box to replace</p>
            </div>

            <!-- Gallery -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 15px;">Add Gallery Images</h3>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.8rem;">Upload new images</label>
                    <input type="file" name="others[]" class="form-control" multiple accept="image/*" style="font-size: 0.85rem;" onchange="previewGallery(this)">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px; margin-bottom: 10px;">
                <i class="ti ti-check"></i> Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; padding: 12px; border: 1px solid var(--border-color); color: var(--text-muted);">
                Cancel
            </a>
        </div>
    </div>
</form>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .ql-toolbar { border-radius: var(--radius) var(--radius) 0 0; border-color: var(--border-color) !important; }
        .ql-container { border-radius: 0 0 var(--radius) var(--radius); border-color: var(--border-color) !important; }
    </style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    // Initialize Quill
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['clean']
            ]
        }
    });

    // Sync Quill to hidden input on submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        document.querySelector('#description').value = quill.root.innerHTML;
    });

    // Primary Image Preview
    function previewPrimary(input) {
        const preview = document.getElementById('primary-preview');
        const placeholder = document.getElementById('upload-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Gallery Images Preview
    function previewGallery(input) {
        const previewContainer = document.getElementById('gallery-preview');
        const noMsg = document.getElementById('no-gallery-msg');
        previewContainer.innerHTML = ''; // Clear existing previews

        if (input.files && input.files.length > 0) {
            if(noMsg) noMsg.style.display = 'none';
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const item = document.createElement('div');
                    item.className = 'gallery-item';
                    item.innerHTML = `<img src="${e.target.result}" alt="Gallery Preview">`;
                    previewContainer.appendChild(item);
                }
                reader.readAsDataURL(file);
            });
        } else {
            if(noMsg) noMsg.style.display = 'block';
        }
    }
</script>
@endpush
@endsection
