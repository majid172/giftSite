@extends('admin.layouts.app')

@push('css')
<style>
    /* Minimal custom overrides if needed, mostly Tailwind now */
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
    .img-preview {
        @apply w-24 h-24 border border-dashed border-slate-300 rounded flex items-center justify-center overflow-hidden mb-2;
    }
</style>
@endpush

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-800">System Settings</h2>
    <div class="text-sm text-slate-500">Manage global configurations</div>
</div>

<div class="flex flex-col lg:flex-row gap-6">
    <!-- Sidebar Navigation -->
    <div class="w-full lg:w-64 flex-shrink-0 bg-white border border-slate-200 rounded-lg overflow-hidden h-fit lg:sticky lg:top-6">
        <button class="w-full flex items-center gap-3 px-5 py-3 text-left font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-100 last:border-0 active" onclick="openTab(event, 'general')">
            <i class="ti ti-settings text-lg"></i> General
        </button>
        <button class="w-full flex items-center gap-3 px-5 py-3 text-left font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-100 last:border-0" onclick="openTab(event, 'media')">
            <i class="ti ti-photo text-lg"></i> Media
        </button>
        <button class="w-full flex items-center gap-3 px-5 py-3 text-left font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-100 last:border-0" onclick="openTab(event, 'seo')">
            <i class="ti ti-world text-lg"></i> SEO
        </button>
        <button class="w-full flex items-center gap-3 px-5 py-3 text-left font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-100 last:border-0" onclick="openTab(event, 'email')">
            <i class="ti ti-mail text-lg"></i> Email
        </button>
        <button class="w-full flex items-center gap-3 px-5 py-3 text-left font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600 transition-colors last:border-0" onclick="openTab(event, 'frontend')">
            <i class="ti ti-layout-navbar text-lg"></i> Frontend Configuration
        </button>
    </div>

    <!-- Content Area -->
    <div class="flex-1 bg-white border border-slate-200 rounded-lg p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- General Tab -->
            <div id="general" class="tab-pane active">
                <h3 class="text-lg font-semibold text-slate-800 border-b border-slate-200 pb-4 mb-6">General Settings</h3>
                
                <!-- System Status Section -->
                <div class="mb-6 p-4 bg-slate-50 border border-slate-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-base font-semibold text-slate-800">
                                Maintenance Mode 
                                @if(get_setting('maintenance_mode') == '1')
                                    <span class="ml-2 px-2 py-0.5 text-[10px] font-bold bg-amber-100 text-amber-700 rounded-full uppercase">Active</span>
                                @else
                                    <span class="ml-2 px-2 py-0.5 text-[10px] font-bold bg-slate-100 text-slate-400 rounded-full uppercase">Inactive</span>
                                @endif
                            </h4>
                            <p class="text-sm text-slate-500">Put your site into maintenance mode. Only admins can access the frontend.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer" {{ get_setting('maintenance_mode') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>

                <!-- Meta Pixel Toggle -->
                <div class="mb-6 p-4 bg-slate-50 border border-slate-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-base font-semibold text-slate-800">Meta Pixel</h4>
                            <p class="text-sm text-slate-500">Enable or disable the Meta Pixel script on the frontend.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="enable_pixel" value="1" class="sr-only peer" {{ get_setting('enable_pixel') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ get_setting('site_name', config('app.name')) }}">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Site Motto</label>
                    <input type="text" name="site_motto" class="form-control" value="{{ get_setting('site_motto') }}">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                    <textarea name="site_description" class="form-control" rows="3">{{ get_setting('site_description') }}</textarea>
                </div>

                 <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Favicon</label>
                    <div class="w-24 h-24 border border-dashed border-slate-300 rounded flex items-center justify-center overflow-hidden mb-2">
                         @if(get_setting('site_favicon'))
                            <img src="{{ asset(get_setting('site_favicon')) }}" alt="Favicon" class="w-full h-full object-contain">
                        @else
                            <i class="ti ti-photo text-3xl text-slate-400"></i>
                        @endif
                    </div>
                    <input type="file" name="site_favicon" class="form-control">
                </div>

                {{-- 50/50 Hero + About Banner Upload --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Page Banner Images</label>
                    <p class="text-xs text-slate-400 mb-4">Upload custom banner images for key pages. Recommended size: <strong>1920×900px</strong>.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Left: Homepage Hero Image --}}
                        <div class="border border-slate-200 rounded-xl p-4 bg-slate-50/50">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <i class="ti ti-home text-emerald-600 text-xs"></i>
                                </div>
                                <span class="text-sm font-semibold text-slate-700">Home Page Hero</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-3">Right-side background of the homepage hero section.</p>

                            {{-- Preview --}}
                            <div id="hero-preview-wrap" class="relative w-full h-40 border border-dashed border-slate-300 rounded-lg overflow-hidden mb-3 bg-white flex items-center justify-center">
                                @if(get_setting('hero_image'))
                                    <img id="hero-preview-img"
                                         src="{{ asset(get_setting('hero_image')) }}"
                                         alt="Hero Preview"
                                         class="w-full h-full object-cover">
                                @else
                                    <div id="hero-preview-placeholder" class="flex flex-col items-center gap-2 text-slate-400">
                                        <i class="ti ti-photo text-3xl"></i>
                                        <span class="text-xs">No image uploaded</span>
                                    </div>
                                    <img id="hero-preview-img" src="" alt="" class="hidden w-full h-full object-cover">
                                @endif
                            </div>

                            <input type="file" name="hero_image" id="hero_image_input" accept="image/*"
                                   class="form-control text-sm" onchange="previewImage(event, 'hero-preview-img', 'hero-preview-placeholder')">
                        </div>

                        {{-- Right: About Page Banner Image --}}
                        <div class="border border-slate-200 rounded-xl p-4 bg-slate-50/50">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center">
                                    <i class="ti ti-info-circle text-amber-600 text-xs"></i>
                                </div>
                                <span class="text-sm font-semibold text-slate-700">About Page Banner</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-3">Right-side background of the about page hero section.</p>

                            {{-- Preview --}}
                            <div id="about-preview-wrap" class="relative w-full h-40 border border-dashed border-slate-300 rounded-lg overflow-hidden mb-3 bg-white flex items-center justify-center">
                                @if(get_setting('about_banner_image'))
                                    <img id="about-preview-img"
                                         src="{{ asset(get_setting('about_banner_image')) }}"
                                         alt="About Banner Preview"
                                         class="w-full h-full object-cover">
                                @else
                                    <div id="about-preview-placeholder" class="flex flex-col items-center gap-2 text-slate-400">
                                        <i class="ti ti-photo text-3xl"></i>
                                        <span class="text-xs">No image uploaded</span>
                                    </div>
                                    <img id="about-preview-img" src="" alt="" class="hidden w-full h-full object-cover">
                                @endif
                            </div>

                            <input type="file" name="about_banner_image" id="about_image_input" accept="image/*"
                                   class="form-control text-sm" onchange="previewImage(event, 'about-preview-img', 'about-preview-placeholder')">
                        </div>

                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-200">
                    <h4 class="text-base font-semibold text-slate-800 mb-4">Contact Info</h4>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ get_setting('contact_email') }}">
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ get_setting('contact_phone') }}">
                    </div>
                     <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Address</label>
                        <textarea name="contact_address" class="form-control" rows="2">{{ get_setting('contact_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Media Tab -->
            <div id="media" class="tab-pane">
                 <h3 class="text-lg font-semibold text-slate-800 border-b border-slate-200 pb-4 mb-6">Media Settings</h3>
                 <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Max Upload Size (KB)</label>
                    <input type="number" name="media_max_size" class="form-control" value="{{ get_setting('media_max_size', 2048) }}">
                    <small class="text-slate-500 mt-1 block">Maximum file size in Kilobytes.</small>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Allowed File Types</label>
                    <input type="text" name="media_allowed_types" class="form-control" value="{{ get_setting('media_allowed_types', 'jpg,jpeg,png,web,pdf') }}">
                </div>
            </div>

            <!-- SEO Tab -->
            <div id="seo" class="tab-pane">
                 <h3 class="text-lg font-semibold text-slate-800 border-b border-slate-200 pb-4 mb-6">SEO Settings</h3>
                 <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Meta Title</label>
                    <input type="text" name="seo_meta_title" class="form-control" value="{{ get_setting('seo_meta_title') }}">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Meta Keywords</label>
                    <input type="text" name="seo_meta_keywords" class="form-control" value="{{ get_setting('seo_meta_keywords') }}">
                </div>
                 <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Meta Description</label>
                    <textarea name="seo_meta_description" class="form-control" rows="3">{{ get_setting('seo_meta_description') }}</textarea>
                </div>
                 <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Google Analytics ID</label>
                    <input type="text" name="seo_analytics_id" class="form-control" value="{{ get_setting('seo_analytics_id') }}">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Facebook Pixel ID</label>
                    <input type="text" name="seo_pixel_id" class="form-control" value="{{ get_setting('seo_pixel_id') }}">
                </div>
            </div>

            <!-- Email Tab -->
             <div id="email" class="tab-pane">
                 <h3 class="text-lg font-semibold text-slate-800 border-b border-slate-200 pb-4 mb-6">Email Configuration</h3>
                 
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">Mail Host</label>
                         <input type="text" name="mail_host" class="form-control" value="{{ get_setting('mail_host') }}">
                     </div>
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">Mail Port</label>
                         <input type="text" name="mail_port" class="form-control" value="{{ get_setting('mail_port') }}">
                     </div>
                 </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                         <input type="text" name="mail_username" class="form-control" value="{{ get_setting('mail_username') }}">
                     </div>
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                         <input type="password" name="mail_password" class="form-control" value="{{ get_setting('mail_password') }}">
                     </div>
                 </div>

                 <div class="mb-5">
                     <label class="block text-sm font-medium text-slate-700 mb-2">Encryption</label>
                     <select name="mail_encryption" class="form-control">
                         <option value="tls" {{ get_setting('mail_encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                         <option value="ssl" {{ get_setting('mail_encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                         <option value="null" {{ get_setting('mail_encryption') == 'null' ? 'selected' : '' }}>None</option>
                     </select>
                 </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">From Address</label>
                         <input type="email" name="mail_from_address" class="form-control" value="{{ get_setting('mail_from_address') }}">
                     </div>
                     <div>
                         <label class="block text-sm font-medium text-slate-700 mb-2">From Name</label>
                         <input type="text" name="mail_from_name" class="form-control" value="{{ get_setting('mail_from_name') }}">
                     </div>
                 </div>
            </div>

            <!-- Frontend Configuration Tab -->
             <div id="frontend" class="tab-pane">
                 <h3 class="text-lg font-semibold text-slate-800 border-b border-slate-200 pb-4 mb-6">About Us Page Content</h3>
                 
                 <!-- Hero Section -->
                 <div class="mb-6 p-5 bg-slate-50 border border-slate-200 rounded-lg">
                    <h4 class="text-base font-medium text-slate-800 mb-4 border-b border-slate-200 pb-2">Hero Section</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Title (Plain Part)</label>
                            <input type="text" name="about_hero_title_main" class="form-control" value="{{ get_setting('about_hero_title_main', 'Crafting') }}" placeholder="e.g., Crafting">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Highlighted Text (Styled Part)</label>
                            <input type="text" name="about_hero_title_highlight" class="form-control" value="{{ get_setting('about_hero_title_highlight', 'Connections') }}" placeholder="e.g., Connections">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Subtitle</label>
                        <textarea name="about_hero_subtitle" class="form-control" rows="3">{{ get_setting('about_hero_subtitle', 'Where every box tells a story of tradition, uncompromising quality, and the timeless art of intentional giving.') }}</textarea>
                    </div>
                 </div>

                 <!-- Mission Section -->
                 <div class="mb-6 p-5 bg-slate-50 border border-slate-200 rounded-lg">
                    <h4 class="text-base font-medium text-slate-800 mb-4 border-b border-slate-200 pb-2">Our Mission</h4>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Mission Statement</label>
                        <textarea name="about_mission_text" class="form-control" rows="3">{{ get_setting('about_mission_text', 'To elevate human connection through the beauty of artisanal craftsmanship and curated luxury.') }}</textarea>
                    </div>
                 </div>

                 <!-- Origins Section -->
                 <div class="mb-6 p-5 bg-slate-50 border border-slate-200 rounded-lg">
                    <h4 class="text-base font-medium text-slate-800 mb-4 border-b border-slate-200 pb-2">The Story / Origins</h4>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Section Title</label>
                        <input type="text" name="about_origins_title" class="form-control" value="{{ get_setting('about_origins_title', 'Our Origins') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Content</label>
                        <p class="text-xs text-slate-500 mb-2">Use the editor below to format your story.</p>
                        <textarea id="origins_editor" name="about_origins_content" class="form-control" rows="8">{{ get_setting('about_origins_content', '<p>Founded in the heart of artisanal traditions, ' . get_setting('site_name', config('app.name')) . ' was born from a simple observation: in a world of instant gratification, the soul of gifting was being lost. We wanted to bring back the "Grandeur" of the unboxing experience.</p><p>What started as a small workshop curating local tea leaves and hand-blown glass has evolved into a global destination for those who seek more than just a product—they seek a moment of genuine connection.</p><p>Every material we use, from sustainable silk ribbons to hand-carved wooden chests, is selected with a singular focus: to create a tactile legacy that honors both giver and receiver.</p>') }}</textarea>
                    </div>
                 </div>

                 <!-- Core Values Section -->
                 <div class="mb-6 p-5 bg-slate-50 border border-slate-200 rounded-lg">
                    <h4 class="text-base font-medium text-slate-800 mb-4 border-b border-slate-200 pb-2">Core Values</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Value 1 -->
                        <div class="bg-white p-4 rounded border border-slate-200">
                            <h5 class="font-medium text-slate-700 mb-3 text-sm">Value 1</h5>
                            <div class="mb-3">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Title</label>
                                <input type="text" name="about_value_1_title" class="form-control text-sm" value="{{ get_setting('about_value_1_title', 'Uncompromising Quality') }}">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Text</label>
                                <textarea name="about_value_1_text" class="form-control text-sm" rows="3">{{ get_setting('about_value_1_text', 'We source only the finest materials, ensuring every gift box is a masterpiece of longevity and beauty.') }}</textarea>
                            </div>
                        </div>

                        <!-- Value 2 -->
                        <div class="bg-white p-4 rounded border border-slate-200">
                            <h5 class="font-medium text-slate-700 mb-3 text-sm">Value 2</h5>
                            <div class="mb-3">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Title</label>
                                <input type="text" name="about_value_2_title" class="form-control text-sm" value="{{ get_setting('about_value_2_title', 'Ethical Sourcing') }}">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Text</label>
                                <textarea name="about_value_2_text" class="form-control text-sm" rows="3">{{ get_setting('about_value_2_text', 'Our partnerships support small-scale artisans and eco-conscious packaging standards around the globe.') }}</textarea>
                            </div>
                        </div>

                        <!-- Value 3 -->
                        <div class="bg-white p-4 rounded border border-slate-200">
                            <h5 class="font-medium text-slate-700 mb-3 text-sm">Value 3</h5>
                            <div class="mb-3">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Title</label>
                                <input type="text" name="about_value_3_title" class="form-control text-sm" value="{{ get_setting('about_value_3_title', 'Intentional Giving') }}">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Text</label>
                                <textarea name="about_value_3_text" class="form-control text-sm" rows="3">{{ get_setting('about_value_3_text', 'We design our products to be more than just boxes; they are bridges that facilitate deep human connections.') }}</textarea>
                            </div>
                        </div>
                    </div>
                 </div>

            </div>

            <div class="mt-8 pt-6 border-t border-slate-200 text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#origins_editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

@push('js')
<script>
    // Live preview for any image upload
    function previewImage(event, imgId, placeholderId) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById(imgId);
            const placeholder = placeholderId ? document.getElementById(placeholderId) : null;

            img.src = e.target.result;
            img.classList.remove('hidden');

            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-pane");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].classList.remove('active');
        }

        // Remove active class from all buttons
        // Logic updated to target generic button within the sidebar wrapper if needed, 
        // but existing onclick matches are fine as long as we clear the styles.
        // Tailwind active state is purely visual here, we toggle specific classes manually if we strictly needed JS,
        // but simplest is just checking class list.
        // Let's rely on a simpler approach: remove 'bg-slate-50' 'text-indigo-600' from all and add to current.
        
        tablinks = document.querySelectorAll(".w-full.flex.items-center"); // Target sidebar buttons
        for (i = 0; i < tablinks.length; i++) {
            // Reset to default state
            tablinks[i].classList.remove("text-indigo-600", "bg-slate-50");
            tablinks[i].classList.add("text-slate-500");
        }

        // Show current tab
        document.getElementById(tabName).style.display = "block";
        document.getElementById(tabName).classList.add('active');
        
        // Activate button
        evt.currentTarget.classList.remove("text-slate-500");
        evt.currentTarget.classList.add("text-indigo-600", "bg-slate-50");
        
        // Save state
        localStorage.setItem('settings_active_tab', tabName);
    }

    // Load saved tab
    document.addEventListener("DOMContentLoaded", function() {
        const savedTab = localStorage.getItem('settings_active_tab') || 'general';
        const tabBtn = document.querySelector(`button[onclick*="'${savedTab}'"]`);
        if(tabBtn) {
            tabBtn.click();
        }
    });
</script>
@endpush
