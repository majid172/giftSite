@extends('admin.layouts.app')

@section('content')
    <div class="">
        <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <!-- ================= General ================= -->
            
            <div class="rounded-box shadow-base-300/10 bg-base-100 shadow-md p-4 my-4">
                <h3 class="text-primary font-semibold mb-4">General Product Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="label-text">Product Name <span class="text-warning">*</span> </label>
                        <input type="text" class="input w-full" name="name" placeholder="Product Name"
                            value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label class="label-text">Category <span class="text-warning">*</span></label>
                        <select class="select w-full" name="category_id" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label-text">Price <span class="text-warning">*</span></label>
                        <input type="number" step="0.01" class="input w-full" name="price" placeholder="Price"
                            value="{{ old('price') }}" required>
                    </div>

                    <div>
                        <label class="label-text">Stock Quantity <span class="text-warning">*</span></label>
                        <input type="number" class="input w-full" name="stock" placeholder="Stock"
                            value="{{ old('stock') }}" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="label-text">Description / Instructions</label>
                    <div class="mb-3" id="editor" style="height: 200px;"></div>
                    <input type="hidden" name="description" id="description">
                </div>
            </div>

            <!-- ================= Images ================= -->
            <div class="rounded-box shadow-base-300/10 bg-base-100 shadow-md p-4 my-4">
                <h3 class="text-primary font-semibold mb-4">Product Images</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Primary Image -->
                    <div>
                        <label class="label-text font-bold block mb-2">Primary Image <span class="text-warning">*</span></label>
                        <input type="file" name="image" class="file-input file-input-bordered w-full" required />
                        <p class="text-xs text-gray-500 mt-1">This will be the main display image.</p>
                    </div>

                    <!-- Others Images -->
                    <div>
                        <label class="label-text font-bold block mb-2">Other Images (Gallery)</label>
                        <input type="file" name="others[]" class="file-input file-input-bordered w-full" multiple />
                        <p class="text-xs text-gray-500 mt-1">You can upload multiple images for the gallery.</p>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="btn btn-primary text-white font-semibold px-6 py-2 rounded-lg shadow" id="submit-btn">
                    Create Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('plugins')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    {{--
    <script src="{{ asset('/assets/plugins/js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#basic-example',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount',
                /* Premium plugins for demo purposes only */
                'mediaembed',
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script> --}}

    <script>
        const toolbarOptions = [
            [{
                'font': []
            }], // Font family
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }], // Headers
            ['bold', 'italic', 'underline', 'strike'], // Text formatting
            [{
                'color': []
            }, {
                'background': []
            }], // Text and background colors
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // Subscript/superscript
            [{
                'header': 1
            }, {
                'header': 2
            }], // Custom headers
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }], // Lists
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // Indent
            [{
                'align': []
            }], // Alignment
            ['link', 'image', 'video'], // Links, images, videos
            ['clean'] // Remove formatting
        ];

        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        // Sync Quill content to hidden input on form submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });
    </script>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('image-link-wrapper');
        const addBtn = document.getElementById('add-link-btn');

        // Function to update delete button visibility
        function updateDeleteButtons() {
            const groups = wrapper.querySelectorAll('.flex.items-center');
            groups.forEach(group => {
                const deleteBtn = group.querySelector('.delete-link');
                if (groups.length > 1) {
                    deleteBtn.classList.remove('hidden');
                } else {
                    deleteBtn.classList.add('hidden');
                }
            });
        }

        // Add new link field
        addBtn.addEventListener('click', function() {
            const template = wrapper.firstElementChild.cloneNode(true);
            const input = template.querySelector('input');
            input.value = ''; // Clear value
            wrapper.appendChild(template);
            updateDeleteButtons();
        });

        // Remove link field
        wrapper.addEventListener('click', function(e) {
            if (e.target.closest('.delete-link')) {
                const row = e.target.closest('.flex.items-center');
                if (wrapper.children.length > 1) {
                    row.remove();
                    updateDeleteButtons();
                }
            }
        });
    });
</script>
@endpush
