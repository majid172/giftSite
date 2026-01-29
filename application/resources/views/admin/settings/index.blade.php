@extends('admin.layouts.app')

@push('css')
<style>
    .kartly-settings-container {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }
    .kartly-breadcrumb {
        margin-bottom: 24px;
        font-size: 14px;
    }
    .kartly-breadcrumb .main-title {
        font-weight: 700;
        font-size: 18px;
        color: #1e293b;
    }
    .kartly-breadcrumb .divider {
        margin: 0 8px;
        color: #94a3b8;
    }
    .kartly-breadcrumb .active-tab {
        color: #3b82f6;
        font-weight: 500;
    }
    .kartly-main-wrapper {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        display: flex;
        min-height: 700px;
        overflow: hidden;
    }
    .kartly-sidebar {
        width: 260px;
        background: #f8fafc;
        border-right: 1px solid #f1f5f9;
        padding: 20px 0;
    }
    .kartly-nav-item {
        display: flex;
        align-items: center;
        padding: 12px 24px;
        cursor: pointer;
        transition: all 0.2s;
        border-right: 3px solid transparent;
        color: #64748b;
        font-weight: 500;
        gap: 12px;
        width: 100%;
        border-radius: 0;
    }
    .kartly-nav-item:hover {
        background: #f1f5f9;
        color: #334155;
    }
    .kartly-nav-item.active {
        background: #ffffff;
        color: #3b82f6;
        border-right: 3px solid #3b82f6;
    }
    .kartly-nav-item i {
        font-size: 18px;
    }
    .kartly-nav-item.active i {
        color: #3b82f6;
    }
    .kartly-content {
        flex: 1;
        padding: 30px 40px;
    }
    .kartly-content-header {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }
    .kartly-form-group {
        display: flex;
        margin-bottom: 30px;
        align-items: flex-start;
    }
    .kartly-label {
        width: 250px;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        padding-top: 10px;
    }
    .kartly-input-wrapper {
        flex: 1;
        max-width: 600px;
    }
    .kartly-input {
        width: 100% !important;
        background: #f1f5f9 !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 10px 16px !important;
        font-size: 14px !important;
        color: #334155 !important;
        transition: ring 0.2s;
    }
    .kartly-input:focus {
        box-shadow: 0 0 0 2px #3b82f6 !important;
        outline: none !important;
    }
    .image-preview-box {
        position: relative;
        width: 100px;
        height: 100px;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        margin-bottom: 10px;
    }
    .image-preview-box.rect {
        border-radius: 4px;
        width: 120px;
        height: 80px;
    }
    .image-preview-box img {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }
    .remove-image-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        color: #94a3b8;
        font-size: 12px;
    }
    .choose-file-link {
        color: #3b82f6;
        font-weight: 500;
        text-decoration: underline;
        cursor: pointer;
        font-size: 14px;
    }
    .logo-grid-header {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 14px;
        color: #334155;
        border-radius: 4px 4px 0 0;
        margin-top: 40px;
    }
    .logo-grid-content {
        border: 1px solid #e2e8f0;
        border-top: none;
        padding: 30px;
        border-radius: 0 0 4px 4px;
    }
    .logo-grid {
        display: grid;
        grid-template-cols: 1fr 1fr;
        gap: 40px;
    }
    .logo-column-title {
        font-weight: 700;
        font-size: 14px;
        color: #334155;
        margin-bottom: 20px;
    }
    .logo-item {
        display: flex;
        margin-bottom: 30px;
        gap: 30px;
    }
    .logo-item-label {
        width: 150px;
        font-weight: 600;
        font-size: 13px;
        color: #475569;
        padding-top: 10px;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
    .save-button {
        background: #3b82f6;
        color: #fff;
        border: none;
        padding: 12px 35px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .save-button:hover {
        background: #2563eb;
    }
</style>
@endpush

@section('content')
<div class="kartly-settings-container">
    {{-- Breadcrumb --}}
    <div class="kartly-breadcrumb">
        <span class="main-title">Business Settings</span>
        <span class="divider">/</span>
        <span id="active-tab-breadcrumb" class="active-tab">General</span>
    </div>

    <div class="kartly-main-wrapper">
        {{-- Sidebar --}}
        <div class="kartly-sidebar">
            <button class="kartly-nav-item active" data-tab="general" onclick="showTab('general', this)">
                <i class="icon-[tabler--settings]"></i>
                General
            </button>
           
            <button class="kartly-nav-item" data-tab="media" onclick="showTab('media', this)">
                <i class="icon-[tabler--photo-edit]"></i>
                Media settings
            </button>
            <button class="kartly-nav-item" data-tab="seo" onclick="showTab('seo', this)">
                <i class="icon-[tabler--file-description]"></i>
                SEO settings
            </button>
        </div>

        {{-- Content Area --}}
        <div class="kartly-content">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- General Tab --}}
                <div id="tab-general" class="tab-content active">
                    <div class="kartly-content-header">General Settings</div>
                    
                    <div class="kartly-form-group">
                        <label class="kartly-label">Site Title</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="site_name" class="kartly-input" value="{{ get_setting('site_name', 'Kartly') }}">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Site Motto</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="site_motto" class="kartly-input" value="{{ get_setting('site_motto', 'Buy more, Earn more') }}">
                        </div>
                    </div>
                    <div class="kartly-form-group">
                        <label class="kartly-label">Site Timezone</label>
                        <div class="kartly-input-wrapper">
                            <select name="site_timezone" class="kartly-input">
                                @foreach(timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" {{ get_setting('site_timezone', 'UTC') == $timezone ? 'selected' : '' }}>{{ $timezone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Site Description</label>
                        <div class="kartly-input-wrapper">
                            <textarea name="site_description" class="kartly-input" rows="3">{{ get_setting('site_description') }}</textarea>
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Copyright Text</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="site_copyright" class="kartly-input" value="{{ get_setting('site_copyright') }}">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Maintenance Mode</label>
                        <div class="kartly-input-wrapper">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input type="checkbox" name="maintenance_mode" class="toggle toggle-primary" value="1" {{ get_setting('maintenance_mode') ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-slate-600">Enable Maintenance Mode</span>
                            </label>
                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="kartly-content-header mt-10">Contact Information</div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Contact Email</label>
                        <div class="kartly-input-wrapper">
                            <input type="email" name="contact_email" class="kartly-input" value="{{ get_setting('contact_email') }}" placeholder="support@example.com">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Contact Phone</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="contact_phone" class="kartly-input" value="{{ get_setting('contact_phone') }}" placeholder="+1 234 567 890">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Offset Address</label>
                        <div class="kartly-input-wrapper">
                            <textarea name="contact_address" class="kartly-input" rows="3" placeholder="123 Street Name, City, Country">{{ get_setting('contact_address') }}</textarea>
                        </div>
                    </div>

                    {{-- Localization --}}
                    <div class="kartly-content-header mt-10">Localization</div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Currency Code</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="currency_code" class="kartly-input" value="{{ get_setting('currency_code', 'USD') }}" placeholder="USD">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Currency Symbol</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="currency_symbol" class="kartly-input" value="{{ get_setting('currency_symbol', '৳') }}" placeholder="৳">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Order Prefix</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="order_prefix" class="kartly-input" value="{{ get_setting('order_prefix', 'ORD-') }}" placeholder="ORD-">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Tax Percentage (%)</label>
                        <div class="kartly-input-wrapper">
                            <input type="number" step="0.01" name="tax_percentage" class="kartly-input" value="{{ get_setting('tax_percentage', '0') }}" placeholder="0">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Favicon</label>
                        <div class="kartly-input-wrapper">
                            <div class="image-preview-box">
                                @if(get_setting('site_favicon'))
                                    <img src="{{ asset(get_setting('site_favicon')) }}" alt="Favicon">
                                @else
                                    <img src="{{ asset('assets/images/default-favicon.png') }}" class="opacity-20" alt="Default">
                                @endif
                                <div class="remove-image-btn" onclick="removeImage('site_favicon')">
                                    <i class="icon-[tabler--x]"></i>
                                </div>
                            </div>
                            <label for="site_favicon" class="choose-file-link">Choose File</label>
                            <input type="file" id="site_favicon" name="site_favicon" class="hidden" onchange="previewSelectedImage(this)">
                        </div>
                    </div>

                    {{-- Logo Section --}}
                    
                    

                    <div style="margin-top: 50px;">
                        <button type="submit" class="save-button">Save Changes</button>
                    </div>
                </div>

                {{-- Other Tabs Placeholders --}}
                <div id="tab-media" class="tab-content">
                    <div class="kartly-content-header">Media Settings</div>
                    
                    <div class="kartly-form-group">
                        <label class="kartly-label">Max Upload Size (KB)</label>
                        <div class="kartly-input-wrapper">
                            <input type="number" name="media_max_size" class="kartly-input" value="{{ get_setting('media_max_size', '2048') }}" placeholder="2048">
                            <div class="text-xs text-slate-400 mt-2">Maximum file size allowed for uploads in Kilobytes.</div>
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Allowed File Types</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="media_allowed_types" class="kartly-input" value="{{ get_setting('media_allowed_types', 'jpg,jpeg,png,gif,webp,pdf') }}" placeholder="jpg,jpeg,png">
                            <div class="text-xs text-slate-400 mt-2">Comma separated list of allowed file extensions.</div>
                        </div>
                    </div>

                    <div style="margin-top: 50px;">
                        <button type="submit" class="save-button">Save Changes</button>
                    </div>
                </div>

                <div id="tab-seo" class="tab-content">
                    <div class="kartly-content-header">SEO Settings</div>
                    
                    <div class="kartly-form-group">
                        <label class="kartly-label">Meta Title</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="seo_meta_title" class="kartly-input" value="{{ get_setting('seo_meta_title') }}" placeholder="Global Meta Title">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Meta Keywords</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="seo_meta_keywords" class="kartly-input" value="{{ get_setting('seo_meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                        </div>
                    </div>
                    
                    <div class="kartly-form-group">
                        <label class="kartly-label">Meta Description</label>
                        <div class="kartly-input-wrapper">
                            <textarea name="seo_meta_description" class="kartly-input" rows="4" placeholder="Global meta description for search engines.">{{ get_setting('seo_meta_description') }}</textarea>
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Social Share Image</label>
                        <div class="kartly-input-wrapper">
                            <div class="image-preview-box rect">
                                @if(get_setting('seo_social_image'))
                                    <img src="{{ asset(get_setting('seo_social_image')) }}" alt="Social Image">
                                @else
                                    <span class="text-slate-300 font-bold">1200x630</span>
                                @endif
                                <div class="remove-image-btn" onclick="removeImage('seo_social_image')">
                                    <i class="icon-[tabler--x]"></i>
                                </div>
                            </div>
                            <label for="seo_social_image" class="choose-file-link">Choose File</label>
                            <input type="file" id="seo_social_image" name="seo_social_image" class="hidden" onchange="previewSelectedImage(this)">
                            <div class="text-xs text-slate-400 mt-2">Recommended size: 1200x630px for Facebook/Twitter.</div>
                        </div>
                    </div>

                    <div class="kartly-content-header mt-10">Analytics & Tracking</div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Google Analytics ID</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="seo_analytics_id" class="kartly-input" value="{{ get_setting('seo_analytics_id') }}" placeholder="UA-XXXXX-Y or G-XXXXXXX">
                        </div>
                    </div>

                    <div class="kartly-form-group">
                        <label class="kartly-label">Facebook Pixel ID</label>
                        <div class="kartly-input-wrapper">
                            <input type="text" name="seo_pixel_id" class="kartly-input" value="{{ get_setting('seo_pixel_id') }}" placeholder="123456789012345">
                        </div>
                    </div>

                    <div style="margin-top: 50px;">
                        <button type="submit" class="save-button">Save Changes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const activeTab = localStorage.getItem('activeSettingsTab') || 'general';
        const btn = document.querySelector(`button[data-tab="${activeTab}"]`);
        if(btn) {
            showTab(activeTab, btn);
        }
    });

    function showTab(tabId, btn) {
        // Save to localStorage
        localStorage.setItem('activeSettingsTab', tabId);

        // Update breadcrumb
        const titles = {
            'general': 'General',
            'media': 'Media settings',
            'seo': 'SEO settings'
        };
        const activeTabEl = document.getElementById('active-tab-breadcrumb');
        if(activeTabEl) {
            activeTabEl.innerText = titles[tabId];
        }

        // Toggle content
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        document.getElementById('tab-' + tabId).classList.add('active');

        // Toggle button active state
        document.querySelectorAll('.kartly-nav-item').forEach(item => {
            item.classList.remove('active');
        });
        btn.classList.add('active');
    }

    function removeImage(inputId) {
        // For now just clear the input if any, or hide preview. 
        // In a real app we might send an AJAX request to delete the file.
        const input = document.getElementById(inputId);
        if(input) input.value = '';
        alert('Image removal logic would go here. For now, it will be replaced upon next upload.');
    }

    function previewSelectedImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = input.previousElementSibling.previousElementSibling.querySelector('img');
                if(previewImg) previewImg.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
