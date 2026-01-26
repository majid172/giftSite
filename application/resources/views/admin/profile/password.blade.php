@extends('admin.layouts.app')

@section('content')
<div class="card bg-base-100 shadow-md max-w-2xl mx-auto">
    <div class="card-body">
        <h2 class="card-title mb-4">Change Password</h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Current Password</span>
                </label>
                <input type="password" name="current_password" class="input input-bordered w-full @error('current_password') input-error @enderror" />
                @error('current_password')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">New Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full @error('password') input-error @enderror" />
                @error('password')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Confirm New Password</span>
                </label>
                <input type="password" name="password_confirmation" class="input input-bordered w-full" />
            </div>

            <div class="card-actions justify-end mt-6">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
