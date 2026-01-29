@extends('admin.layouts.app')



@section('content')
<div class="kartly-settings-container">
    {{-- Breadcrumb --}}
    <div class="kartly-breadcrumb">
        <span class="main-title">Edit User</span>
        
    </div>

    <div class="kartly-main-wrapper">
        {{-- Content Area --}}
        <div class="kartly-content">
            <div class="kartly-content-header">Edit Profile: {{ $user->name }}</div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="kartly-form-group">
                    <label class="kartly-label">Full Name</label>
                    <div class="kartly-input-wrapper">
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="kartly-input bg-slate-100 text-slate-500 cursor-not-allowed" readonly>
                    </div>
                </div>

                <div class="kartly-form-group">
                    <label class="kartly-label">Email Address</label>
                    <div class="kartly-input-wrapper">
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="kartly-input bg-slate-100 text-slate-500 cursor-not-allowed" readonly>
                    </div>
                </div>

                <div class="kartly-form-group">
                    <label class="kartly-label">Phone Number</label>
                    <div class="kartly-input-wrapper">
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="kartly-input bg-slate-100 text-slate-500 cursor-not-allowed" readonly>
                    </div>
                </div>

             
                <div class="kartly-form-group">
                    <label class="kartly-label">Status</label>
                    <div class="kartly-input-wrapper">
                        <select name="status" class="kartly-input">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="text-xs text-slate-400 mt-2">
                            <span class="icon-[tabler--info-circle] size-3 relative top-0.5"></span>
                            Setting status to "Inactive" will prevent login.
                        </div>
                    </div>
                </div>

                <div style="margin-top: 50px; display: flex; align-items: center;">
                    <a href="{{ route('admin.users.index') }}" class="cancel-link">Cancel</a>
                    <button type="submit" class="save-button">Update Status</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
