@extends('admin.layouts.app')

@section('content')
<div class="card bg-base-100 shadow-md max-w-2xl mx-auto">
    <div class="card-body">
        <h2 class="card-title mb-4">Edit Profile</h2>

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full @error('name') input-error @enderror" />
                @error('name')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full @error('email') input-error @enderror" />
                @error('email')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="card-actions justify-end mt-6">
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
