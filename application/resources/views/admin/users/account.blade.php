@extends('panel.layouts.app')
@section('content')
    <div class="card mb-6">
        <div class="card-header">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-success  p-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="card-body gap-6">
            @if (!auth()->user()->is_admin || auth()->id() == $user->id)
                <div class="border-base-content/20 flex items-end gap-6 border-b pb-4">
                    <div class="avatar">
                        <div class="size-25 rounded-field">
                            <img src="../assets/img/avatars/2.png" alt="avatar" />
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary mb-4 me-4">
                            <i class="icon-[tabler--upload] block sm:hidden"></i>
                            <span class="hidden sm:block">Upload new photo</span>
                        </button>
                        <button type="button" class="btn btn-soft btn-secondary mb-4">
                            <i class="icon-[tabler--rotate-clockwise] block sm:hidden"></i>
                            <span class="hidden sm:block">Reset</span>
                        </button>
                        <p class="text-sm">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            @endif
            <form class="space-y-6" action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="label-text" for="name">Name</label>
                        <input type="text" id="name" name="name" class="input" placeholder="John"
                            value="{{ $user->name }}"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>

                    <div>
                        <label class="label-text" for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="input"
                            placeholder="john.doe@example.com" value="{{ $user->email }}" readonly />
                    </div>

                    <div>
                        <label class="label-text" for="number">Phone Number</label>
                        <input type="text" id="number" name="phone" value="{{ $user->userDetail?->phone }}"
                            class="input" placeholder="202 555 0111"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>
                    <div>
                        <label class="label-text" for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ $user->userDetail?->address }}"
                            class="input" placeholder="Address"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>
                    <div>
                        <label class="label-text" for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ $user->userDetail?->city }}"
                            class="input" placeholder="City"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>
                    <div>
                        <label class="label-text" for="state">State</label>
                        <input type="state" id="state" name="state" value="{{ $user->userDetail?->state }}"
                            class="input" placeholder="California"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>
                    <div>
                        <label class="label-text" for="zipCode">Zip Code</label>
                        <input type="text" id="zipCode" value="{{ $user->userDetail?->post_code }}" name="post_code"
                            class="input" placeholder="231465" maxlength="6"
                            {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? 'disabled' : '' }} />
                    </div>
                    <div>
                        <label class="label-text" for="country">Country</label>
                        <div class="max-w-full">
                            <select
                                data-select='{
    "placeholder": "Select",
    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"  {{ auth()->user()->is_admin == 1 && auth()->id() != $user->id ? "disabled" : "" }}></button>",
    "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
    "hasSearch": true,
    "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
    "optionClasses": "advance-select-option selected:select-active",
    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
    "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
    }'
                                class="hidden" name="country_id">
                                <option value="">Select</option>

                                @foreach ($countries as $key => $country)
                                    <option value="{{ $country->id }}"
                                        {{ $country->id == $user->userDetail?->country_id ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="label-text" for="language">Status</label>
                        <div class="max-w-full">
                            <select
                                data-select='{
    "placeholder": "Select Status",
    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
    "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
    "hasSearch": true,
    "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
    "optionClasses": "advance-select-option selected:select-active",
    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
    "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
    }'
                                class="hidden" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                <option value="2">Ban</option>

                            </select>
                        </div>
                    </div>

                </div>
                <!-- Submit Button -->
                <div class="flex gap-3">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <button class="btn btn-soft btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <h5 class="text-base-content text-lg font-medium">Delete Account</h5>
        </div>
        <div class="card-body gap-8">
            <div class="alert alert-soft alert-warning mb-1 border-0" role="alert">
                <h5 class="text-lg font-medium">Are you sure you want to delete your account?</h5>
                <p>Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            <div class="ms-2 flex items-center gap-1">
                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" id="checkboxPrimary" />
                <label class="label-text text-base" for="checkboxPrimary">I confirm my account deactivation</label>
            </div>
            <div class="card-actions">
                <button class="btn btn-error">Deactivate Account</button>
            </div>
        </div>
    </div> --}}
@endsection
