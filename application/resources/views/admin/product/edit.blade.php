@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Edit Product</h1>
                <p class="text-sm text-gray-500 mt-1">Modify information for <span class="text-primary font-medium">{{ $product->name }}</span></p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">
                <span class="icon-[tabler--arrow-left] size-4"></span>
                Back to List
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: General Information -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- General Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span class="icon-[tabler--info-circle] size-6 text-primary"></span>
                            General Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Product Name <span class="text-error">*</span></span></label>
                                <input type="text" name="name" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('name') input-error @enderror" value="{{ old('name', $product->name) }}" required>
                                @error('name') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Category <span class="text-error">*</span></span></label>
                                <select name="category_id" class="select select-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('category_id') select-error @enderror" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Price ($) <span class="text-error">*</span></span></label>
                                <input type="number" step="0.01" name="price" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('price') input-error @enderror" value="{{ old('price', $product->price) }}" required>
                                @error('price') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Old Price ($) <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="number" step="0.01" name="old_price" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('old_price') input-error @enderror" value="{{ old('old_price', $product->old_price) }}">
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Stock Quantity <span class="text-error">*</span></span></label>
                                <input type="number" name="stock" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('stock') input-error @enderror" value="{{ old('stock', $product->stock) }}" required>
                                @error('stock') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Badge Text <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="text" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all" name="badge" placeholder="e.g. BEST SELLER" value="{{ old('badge', $product->badge) }}">
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Badge Color Class <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="text" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all" name="badge_color" placeholder="e.g. bg-amber-500" value="{{ old('badge_color', $product->badge_color) }}">
                            </div>
                        </div>

                        <div class="form-control mt-6">
                            <label class="label"><span class="label-text font-bold text-gray-700">Description</span></label>
                            <div id="editor" style="height: 300px;" class="rounded-xl border border-gray-300">
                                {!! old('description', $product->description) !!}
                            </div>
                            <input type="hidden" name="description" id="description">
                        </div>
                    </div>

                    <!-- Images Gallery Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <span class="icon-[tabler--photo] size-6 text-primary"></span>
                                Product Gallery
                            </h3>
                        </div>

                        <!-- Existing Gallery Images -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-8">
                            @foreach($product->images as $galleryImg)
                                <div class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100 bg-gray-50 shadow-sm transition-all hover:shadow-md" id="gallery-img-{{ $galleryImg->id }}">
                                    <img src="{{ asset($galleryImg->image_path) }}" class="h-full w-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button type="button" onclick="deleteGalleryImage({{ $galleryImg->id }})" class="btn btn-error btn-sm btn-circle shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                            <span class="icon-[tabler--trash] size-5 text-white"></span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Add More Placeholder / Info -->
                            <div class="aspect-square rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
                                <span class="icon-[tabler--plus] size-8 mb-1"></span>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Add More Below</span>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-gray-700">Upload New Gallery Images</span></label>
                            <input type="file" name="others[]" class="file-input file-input-bordered w-full" multiple accept="image/*">
                            <p class="text-[10px] text-gray-400 mt-2 italic">You can select multiple images to add to the gallery.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Primary Image & Status -->
                <div class="space-y-8">
                    <!-- Primary Image Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                         <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span class="icon-[tabler--star] size-5 text-yellow-500"></span>
                            Primary Image
                        </h3>
                        
                        <div class="mb-6">
                            <div class="relative aspect-square rounded-2xl overflow-hidden border border-gray-200 bg-gray-50 shadow-inner group">
                                <img id="primary-preview" src="{{ $product->image ? asset($product->image) : 'https://placehold.co/400x400?text=No+Image' }}" class="h-full w-full object-contain">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-gray-700">Replace Primary Image</span></label>
                            <input type="file" name="image" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" onchange="previewPrimary(this)">
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <button type="submit" class="btn btn-primary w-full gap-2 rounded-xl py-4 h-auto text-lg shadow-lg shadow-primary/20">
                            <span class="icon-[tabler--device-floppy] size-6"></span>
                            Update Product
                        </button>
                        
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-ghost w-full mt-4 rounded-xl">
                            Cancel Changes
                        </a>
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
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('primary-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // AJAX Delete Gallery Image
        function deleteGalleryImage(id) {
            if (confirm('Are you sure you want to remove this image from the gallery?')) {
                fetch(`/admin/products/image/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const el = document.getElementById(`gallery-img-${id}`);
                        el.style.transform = 'scale(0)';
                        el.style.opacity = '0';
                        setTimeout(() => el.remove(), 300);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete image.');
                });
            }
        }
    </script>
    @endpush
@endsection
