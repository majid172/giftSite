@extends('admin.layouts.app')

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600;">Edit User</h2>
        <div style="color: var(--text-muted); font-size: 0.875rem;">Manage user details and status</div>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
        <i class="ti ti-arrow-left"></i> Back to List
    </a>
</div>

<div class="card max-w-3xl">
    <div class="card-header">
        <span class="card-title">User Profile: {{ $user->name }}</span>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-5 pb-5 border-b border-gray-200 mb-5">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" value="{{ old('name', $user->name) }}" class="form-control" style="background-color: #f8fafc; color: #64748b; cursor: not-allowed;" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" value="{{ old('email', $user->email) }}" class="form-control" style="background-color: #f8fafc; color: #64748b; cursor: not-allowed;" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" value="{{ old('phone', $user->phone) }}" class="form-control" style="background-color: #f8fafc; color: #64748b; cursor: not-allowed;" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Account Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px; display: flex; align-items: center; gap: 4px;">
                    <i class="ti ti-info-circle"></i> Setting status to "Inactive" will prevent the user from logging in.
                </div>
            </div>
        </div>

        <div style="text-align: right;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="margin-right: 10px;">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Update Status
            </button>
        </div>
    </form>
</div>
@endsection
