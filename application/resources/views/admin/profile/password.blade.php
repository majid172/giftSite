@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Change Password</h2>
        <div class="text-sm text-slate-500">Update your account security</div>
    </div>

    <!-- Card -->
    <div class="bg-white border border-slate-200 rounded-lg p-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center gap-2">
                <i class="ti ti-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Current Password</label>
                <input type="password" name="current_password" class="form-control @error('current_password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                @error('current_password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">New Password</label>
                <input type="password" name="password" class="form-control @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="pt-6 border-t border-slate-200 text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
