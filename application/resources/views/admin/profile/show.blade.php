@extends('admin.layouts.app')

@section('content')
<div class="card bg-base-100 shadow-md">
    <div class="card-body">
        <h2 class="card-title mb-4">User Profile</h2>
        
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center gap-6 mb-6">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="{{ asset('/assets/images/man.png') }}" class="w-full" alt="Avatar" />
                </div>
            </div>
            <div>
                <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                <p class="text-base-content/70">{{ $user->email }}</p>
                <div class="badge badge-primary mt-2">{{ ucfirst($user->role) }}</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label">
                    <span class="label-text font-semibold">Name</span>
                </label>
                <div class="text-lg">{{ $user->name }}</div>
            </div>
            <div>
                <label class="label">
                    <span class="label-text font-semibold">Email</span>
                </label>
                <div class="text-lg">{{ $user->email }}</div>
            </div>
             <div>
                <label class="label">
                    <span class="label-text font-semibold">Joined At</span>
                </label>
                <div class="text-lg">{{ dateFormat($user->created_at) }}</div>
            </div>
        </div>

        <div class="card-actions justify-end mt-6">
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('password') }}" class="btn btn-secondary">Change Password</a>
        </div>
    </div>
</div>
@endsection
