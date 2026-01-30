
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
        <h2 style="font-size: 1.5rem; font-weight: 600;">Edit Product</h2>
        <div style="color: var(--text-muted); font-size: 0.875rem;">Editing: {{ $product->name }}</div>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
        <i class="ti ti-arrow-left"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-layout">
        <div class="main-col">
            <!-- General Info -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">General Information</h3>
                
                <div class="form-group">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    @error('name') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                         @error('stock') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        @error('price') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Old Price ($)</label>
                        <input type="number" step="0.01" name="old_price" class="form-control" value="{{ old('old_price', $product->old_price) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <div id="editor" style="height: 200px; background: white; border-radius: var(--radius); border: 1px solid var(--border-color);">{!! old('description', $product->description) !!}</div>
                    <input type="hidden" name="description" id="description" value="{{ old('description', $product->description) }}">
                </div>
            </div>

            <!-- Existing Gallery -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px;">Existing Gallery Images</h3>
                 @if($product->images && $product->images->count() > 0)
                    <div class="gallery-grid">
                        @foreach($product->images as $galleryImg)
                            <div class="gallery-item" id="gallery-img-{{ $galleryImg->id }}">
                                <img src="{{ asset($galleryImg->image_path) }}" alt="Gallery Image">
                                <button type="button" class="delete-btn" onclick="deleteGalleryImage({{ $galleryImg->id }})" title="Delete">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; color: var(--text-muted); padding: 20px;">No gallery images found.</div>
                @endif
            </div>

            <!-- Badges -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Product Badge</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Badge Text</label>
                        <input type="text" name="badge" class="form-control" value="{{ old('badge', $product->badge) }}" placeholder="e.g. NEW">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Badge Color</label>
                         <input type="text" name="badge_color" class="form-control" value="{{ old('badge_color', $product->badge_color) }}" placeholder="e.g. bg-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <div class="side-col">
            <!-- Main Image -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 15px;">Primary Image</h3>
                <div class="img-upload-box" onclick="document.getElementById('image').click()">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewPrimary(this)">
                    
                    @if($product->image)
                        <div id="upload-placeholder" class="hidden">
                             <i class="ti ti-photo-plus" style="font-size: 2rem; color: var(--text-muted);"></i>
                             <p class="upload-hint">Click to replace</p>
                        </div>
                        <img id="primary-preview" src="{{ asset($product->image) }}" alt="Preview">
                    @else
                        <div id="upload-placeholder">
                             <i class="ti ti-photo-plus" style="font-size: 2rem; color: var(--text-muted);"></i>
                             <p class="upload-hint">Click to upload</p>
                        </div>
                        <img id="primary-preview" src="#" alt="Preview" class="hidden">
                    @endif
                </div>
                @error('image') <div class="text-danger" style="font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div> @enderror
                <p class="upload-hint" style="margin-top: 10px; text-align: center;">Click box to replace</p>
            </div>

            <!-- Gallery -->
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 15px;">Add Gallery Images</h3>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.8rem;">Upload new images</label>
                    <input type="file" name="others[]" class="form-control" multiple accept="image/*" style="font-size: 0.85rem;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px; margin-bottom: 10px;">
                <i class="ti ti-device-floppy"></i> Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; padding: 12px; border: 1px solid var(--border-color); color: var(--text-muted);">
                Cancel
            </a>
        </div>
    </div>
</form>

@push('plugins')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .ql-toolbar { border-radius: var(--radius) var(--radius) 0 0; border-color: var(--border-color) !important; }
        .ql-container { border-radius: 0 0 var(--radius) var(--radius); border-color: var(--border-color) !important; }
    </style>
@endpush

@push('js')
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

    // AJAX Delete Gallery Image
    function deleteGalleryImage(id) {
        if (confirm('Are you sure you want to remove this image?')) {
            fetch(`/admin/products/image/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const el = document.getElementById(`gallery-img-${id}`);
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 300);
                } else {
                    alert('Failed to delete image: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the image.');
            });
        }
    }
</script>
@endpush
@endsection
