@extends('admin.layouts.app')

@section('content')
<div class="card bg-base-100 shadow-xl max-w-2xl mx-auto">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-6">Edit User: {{ $user->name }}</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Full Name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" required />
                </div>

                <!-- Email -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email Address</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full" required />
                </div>

                <!-- Phone -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Phone Number</span>
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input input-bordered w-full" />
                </div>

                <!-- Role -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select name="role" class="select select-bordered w-full">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Customer</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select name="status" class="select select-bordered w-full">
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            
            <div class="alert alert-info mt-6 text-sm">
                <span class="icon-[tabler--info-circle] size-5"></span>
                <span>Note: Changing the status to "Inactive" will prevent the user from logging in.</span>
            </div>

            <div class="card-actions justify-end mt-6">
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
