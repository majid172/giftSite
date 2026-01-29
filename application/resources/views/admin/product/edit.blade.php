@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--pencil] size-6"></span>
            Edit Product
        </div>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            <span class="icon-[tabler--arrow-left] size-4"></span>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Column: Product Information -->
            <div class="w-full lg:w-2/3 space-y-6">
                <!-- General Info Card -->
                <div class="section-card">
                    <div class="card-header">General Information</div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Product Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                @error('name') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="form-group flex-1">
                                    <label class="form-label" for="category_id">Category <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group flex-1">
                                    <label class="form-label" for="stock">Stock Quantity <span class="text-red-500">*</span></label>
                                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                                    @error('stock') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="form-group flex-1">
                                    <label class="form-label" for="price">Price ($) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                                    @error('price') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group flex-1">
                                    <label class="form-label" for="old_price">Old Price ($) <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                    <input type="number" step="0.01" name="old_price" id="old_price" class="form-control" value="{{ old('old_price', $product->old_price) }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <div id="editor" style="height: 200px; background: white;" class="rounded-md border border-slate-200">{!! old('description', $product->description) !!}</div>
                                <input type="hidden" name="description" id="description" value="{{ old('description', $product->description) }}">
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Gallery Management Card -->
                 <div class="section-card">
                    <div class="card-header">Existing Gallery Images</div>
                    <div class="card-body">
                        @if($product->images && $product->images->count() > 0)
                            <div class="flex flex-wrap gap-4">
                                @foreach($product->images as $galleryImg)
                                    <div class="relative group w-32 h-32 rounded-lg overflow-hidden border border-slate-200 shadow-sm transition-all hover:shadow-md hover:border-blue-400" id="gallery-img-{{ $galleryImg->id }}">
                                        <img src="{{ asset($galleryImg->image_path) }}" class="h-full w-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[1px]">
                                            <button type="button" onclick="deleteGalleryImage({{ $galleryImg->id }})" class="bg-white text-red-500 hover:text-red-600 hover:bg-red-50 p-2 rounded-full transition-all transform scale-90 group-hover:scale-100 shadow-lg" title="Delete Image">
                                                <span class="icon-[tabler--trash] size-5"></span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-slate-400 text-sm">
                                No gallery images uploaded.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Badges Card -->
                <div class="section-card">
                    <div class="card-header">Product Badge</div>
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="form-group flex-1">
                                <label class="form-label" for="badge">Badge Text <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                <input type="text" name="badge" id="badge" class="form-control" value="{{ old('badge', $product->badge) }}" placeholder="e.g. NEW">
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="badge_color">Badge Color Class <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                <input type="text" name="badge_color" id="badge_color" class="form-control" value="{{ old('badge_color', $product->badge_color) }}" placeholder="e.g. bg-blue-500">
                                <div class="text-xs text-gray-400 mt-1">Accepts Tailwind color classes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Images & Publish -->
            <div class="w-full lg:w-1/3 space-y-6">
                <div class="flex gap-4">
                    <div class="section-card flex-1">
                        <div class="card-header">Primary Image</div>
                        <div class="card-body">
                            <div class="image-preview-box" onclick="document.getElementById('image').click()">
                                <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewPrimary(this)">
                                @if($product->image)
                                    <img id="primary-preview" src="{{ asset($product->image) }}" alt="Preview" class="image-preview">
                                    <div id="upload-placeholder" class="upload-placeholder hidden">
                                        <span class="icon-[tabler--photo-plus] size-8 text-slate-400 mb-1"></span>
                                        <p class="text-xs text-slate-500 font-medium">Click to replace</p>
                                    </div>
                                @else
                                    <div id="upload-placeholder" class="upload-placeholder">
                                        <span class="icon-[tabler--photo-plus] size-8 text-slate-400 mb-1"></span>
                                        <p class="text-xs text-slate-500 font-medium">Click to upload</p>
                                    </div>
                                    <img id="primary-preview" src="#" alt="Preview" class="image-preview hidden">
                                @endif
                                
                            </div>
                            <div class="text-xs text-center text-slate-400 mt-2">Click image to replace</div>
                            @error('image') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="section-card flex-1 h-full"> 
                        <div class="card-header">Add Gallery Images</div>
                        <div class="card-body">
                             <div class="form-group">
                                <label class="form-label text-xs mb-2">Upload new images</label>
                                <input type="file" name="others[]" class="form-control text-sm" multiple accept="image/*">
                                <div class="text-xs text-slate-400 mt-2 italic">Hold Ctrl/Cmd to select multiple files</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card">
                    <div class="card-header">Publish Changes</div>
                    <div class="card-body">
                        <button type="submit" class="save-btn w-full justify-center">
                            <span class="icon-[tabler--device-floppy] size-5"></span>
                            Update Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="action-btn w-full mt-3 justify-center bg-slate-100 hover:bg-slate-200 text-slate-600 no-underline py-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('plugins')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                ['link', 'clean']
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
