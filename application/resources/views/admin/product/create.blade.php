@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Create Product</h1>
                <p class="text-sm text-gray-500 mt-1">Add a new product to your catalog</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">
                <span class="icon-[tabler--arrow-left] size-4"></span>
                Back to List
            </a>
        </div>

        <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

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
                                <input type="text" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('name') input-error @enderror" name="name" placeholder="e.g. Luxury Gift Box" value="{{ old('name') }}" required>
                                @error('name') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Category <span class="text-error">*</span></span></label>
                                <select class="select select-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('category_id') select-error @enderror" name="category_id" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Price ($) <span class="text-error">*</span></span></label>
                                <input type="number" step="0.01" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('price') input-error @enderror" name="price" placeholder="0.00" value="{{ old('price') }}" required>
                                @error('price') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Old Price ($) <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="number" step="0.01" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('old_price') input-error @enderror" name="old_price" placeholder="0.00" value="{{ old('old_price') }}">
                                <span class="text-xs text-gray-400 mt-1">Shows as strikethrough if set</span>
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Stock Quantity <span class="text-error">*</span></span></label>
                                <input type="number" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all @error('stock') input-error @enderror" name="stock" placeholder="0" value="{{ old('stock') }}" required>
                                @error('stock') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Badge Text <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="text" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all" name="badge" placeholder="e.g. BEST SELLER" value="{{ old('badge') }}">
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-gray-700">Badge Color Class <span class="text-gray-400 font-normal">(Optional)</span></span></label>
                                <input type="text" class="input input-bordered w-full focus:ring-2 focus:ring-primary/20 transition-all" name="badge_color" placeholder="e.g. bg-amber-500" value="{{ old('badge_color') }}">
                                <span class="text-xs text-gray-400 mt-1">Tailwind class (e.g., bg-red-500, bg-blue-600)</span>
                            </div>
                        </div>

                        <div class="form-control mt-6">
                            <label class="label"><span class="label-text font-bold text-gray-700">Description</span></label>
                            <div id="editor" style="height: 200px;" class="rounded-xl border border-gray-300"></div>
                            <input type="hidden" name="description" id="description">
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Images & Actions -->
                <div class="space-y-8">
                    <!-- Primary Image Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span class="icon-[tabler--star] size-5 text-yellow-500"></span>
                            Primary Image <span class="text-error">*</span>
                        </h3>
                        
                        <div class="mb-6">
                            <div class="relative aspect-square rounded-2xl overflow-hidden border border-gray-200 bg-gray-50 shadow-inner group flex items-center justify-center">
                                <img id="primary-preview" src="#" class="hidden h-full w-full object-contain">
                                <div id="upload-placeholder" class="text-center p-6">
                                    <span class="icon-[tabler--photo-plus] size-12 text-gray-300 mb-2"></span>
                                    <p class="text-sm text-gray-400">Upload Image</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-control">
                            <input type="file" name="image" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" onchange="previewPrimary(this)" required>
                            @error('image') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Gallery Images Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                         <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span class="icon-[tabler--photo] size-5 text-primary"></span>
                            Gallery Images
                        </h3>

                        <div class="form-control">
                            <input type="file" name="others[]" class="file-input file-input-bordered w-full" multiple accept="image/*">
                            <p class="text-[10px] text-gray-400 mt-2 italic">Select multiple images for the gallery.</p>
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <button type="submit" class="btn btn-primary w-full gap-2 rounded-xl py-4 h-auto text-lg shadow-lg shadow-primary/20">
                            <span class="icon-[tabler--check] size-6"></span>
                            Create Product
                        </button>
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
