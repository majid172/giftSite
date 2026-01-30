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
    <div class="w-full lg:w-64 flex-shrink-0 bg-white border border-slate-200 rounded-lg overflow-hidden h-fit">
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
                            <h4 class="text-base font-semibold text-slate-800">Maintenance Mode</h4>
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

            <div class="mt-8 pt-6 border-t border-slate-200 text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        
        // Hide all tab content
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
