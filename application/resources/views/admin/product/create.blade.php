@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--box] size-6"></span>
            Create New Product
        </div>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            <span class="icon-[tabler--arrow-left] size-4"></span>
            Back to List
        </a>
    </div>

    <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
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
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Luxury Gift Box" required>
                                @error('name') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="form-group flex-1">
                                    <label class="form-label" for="category_id">Category <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group flex-1">
                                    <label class="form-label" for="stock">Stock Quantity <span class="text-red-500">*</span></label>
                                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" placeholder="0" required>
                                    @error('stock') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="form-group flex-1">
                                    <label class="form-label" for="price">Price ($) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="0.00" required>
                                    @error('price') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group flex-1">
                                    <label class="form-label" for="old_price">Old Price ($) <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                    <input type="number" step="0.01" name="old_price" id="old_price" class="form-control" value="{{ old('old_price') }}" placeholder="0.00">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <div id="editor" style="height: 200px; background: white;" class="rounded-md border border-slate-200"></div>
                                <input type="hidden" name="description" id="description">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Badges Card -->
                <div class="section-card">
                    <div class="card-header">Product Badge</div>
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="form-group flex-1">
                                <label class="form-label" for="badge">Badge Text <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                <input type="text" name="badge" id="badge" class="form-control" value="{{ old('badge') }}" placeholder="e.g. NEW">
                            </div>
                            <div class="form-group flex-1">
                                <label class="form-label" for="badge_color">Badge Color Class <span class="text-gray-400 font-normal text-xs ml-1">(Optional)</span></label>
                                <input type="text" name="badge_color" id="badge_color" class="form-control" value="{{ old('badge_color') }}" placeholder="e.g. bg-blue-500">
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
                        <div class="card-header">Primary Image <span class="text-red-500">*</span></div>
                        <div class="card-body">
                            <div class="image-preview-box" onclick="document.getElementById('image').click()">
                                <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewPrimary(this)" required>
                                <div id="upload-placeholder" class="upload-placeholder">
                                    <span class="icon-[tabler--photo-plus] size-8 text-slate-400 mb-1"></span>
                                    <p class="text-xs text-slate-500 font-medium">Click to upload</p>
                                </div>
                                <img id="primary-preview" src="#" alt="Preview" class="image-preview hidden">
                            </div>
                            @error('image') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="section-card flex-1 h-full"> <! -- Added h-full to match height if needed -->
                        <div class="card-header">Gallery Images</div>
                        <div class="card-body">
                             <div class="form-group">
                                <label class="form-label text-xs mb-2">Upload multiple images</label>
                                <input type="file" name="others[]" class="form-control text-sm" multiple accept="image/*">
                                <div class="text-xs text-slate-400 mt-2 italic">Hold Ctrl/Cmd to select multiple files</div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="section-card">
                    <div class="card-header">Publish</div>
                    <div class="card-body">
                        <button type="submit" class="save-btn w-full justify-center">
                            <span class="icon-[tabler--check] size-5"></span>
                            Create Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('plugins')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
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
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
