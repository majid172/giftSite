@extends('admin.layouts.app')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold">General Site Settings</h1>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="card bg-base-100 shadow-xl max-w-4xl mx-auto">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Identity -->
                <div class="col-span-full">
                    <h3 class="text-lg font-semibold mb-3">Site Identity</h3>
                    <div class="form-control mb-4">
                        <label class="label" for="site_name">
                            <span class="label-text">Site Name</span>
                        </label>
                        <input type="text" name="site_name" id="site_name" class="input input-bordered w-full" value="{{ get_setting('site_name') }}">
                    </div>
                     <div class="form-control mb-4">
                        <label class="label" for="site_description">
                            <span class="label-text">Site Description</span>
                        </label>
                        <textarea name="site_description" id="site_description" class="textarea textarea-bordered h-24 w-full">{{ get_setting('site_description') }}</textarea>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-span-full">
                    <h3 class="text-lg font-semibold mb-3">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label" for="contact_email">
                                <span class="label-text">Contact Email</span>
                            </label>
                            <input type="email" name="contact_email" id="contact_email" class="input input-bordered w-full" value="{{ get_setting('contact_email') }}">
                        </div>
                        <div class="form-control">
                            <label class="label" for="contact_phone">
                                <span class="label-text">Contact Phone</span>
                            </label>
                            <input type="text" name="contact_phone" id="contact_phone" class="input input-bordered w-full" value="{{ get_setting('contact_phone') }}">
                        </div>
                    </div>
                    <div class="form-control mt-4">
                        <label class="label" for="contact_address">
                            <span class="label-text">Address</span>
                        </label>
                        <textarea name="contact_address" id="contact_address" class="textarea textarea-bordered h-16 w-full">{{ get_setting('contact_address') }}</textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="col-span-full">
                     <h3 class="text-lg font-semibold mb-3">Footer</h3>
                    <div class="form-control">
                        <label class="label" for="footer_text">
                            <span class="label-text">Footer Text</span>
                        </label>
                        <input type="text" name="footer_text" id="footer_text" class="input input-bordered w-full" value="{{ get_setting('footer_text') }}">
                    </div>
                </div>

                <!-- Logo & Icons -->
                <div class="col-span-full">
                    <h3 class="text-lg font-semibold mb-3">Logo & Branding</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label" for="site_logo">
                                <span class="label-text">Site Logo</span>
                            </label>
                            <input type="file" name="site_logo" id="site_logo" class="file-input file-input-bordered w-full">
                            @if(get_setting('site_logo'))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . get_setting('site_logo')) }}" alt="Site Logo" class="h-16 object-contain">
                                </div>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label" for="site_favicon">
                                <span class="label-text">Favicon</span>
                            </label>
                            <input type="file" name="site_favicon" id="site_favicon" class="file-input file-input-bordered w-full">
                             @if(get_setting('site_favicon'))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . get_setting('site_favicon')) }}" alt="Favicon" class="h-8 w-8 object-contain">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-actions justify-end mt-8">
                <button type="submit" class="btn btn-primary">
                    <span class="icon-[tabler--device-floppy] size-5"></span>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
