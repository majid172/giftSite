@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">User Management</h2>
        <!-- Optional: Add filters or buttons here if needed -->
    </div>

    @if(session('success'))
    <div style="background-color: #ECFDF5; border: 1px solid #10B981; color: #047857; padding: 12px; border-radius: var(--radius); margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="80">Avatar</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                <tr>
                    <td>
                        <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--text-muted);">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                            @else
                                {{ substr($item->name, 0, 1) }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-main);">{{ Str::ucfirst($item->name) }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">ID: #{{ $item->id }}</div>
                    </td>
                    <td>
                        <span style="color: var(--secondary);">{{ $item->email }}</span>
                    </td>
                    <td>
                        <span style="color: var(--secondary);">{{ $item->phone ?? 'N/A' }}</span>
                    </td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-outline btn-icon" style="padding: 4px 8px;" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>
                        
                        <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-icon" style="padding: 4px 8px; color: var(--danger); border-color: var(--danger);" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                            <div style="width: 64px; height: 64px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <i class="ti ti-users-off" style="font-size: 2rem;"></i>
                            </div>
                            <div style="color: var(--text-muted); font-weight: 500;">No users found</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div style="padding-top: 20px;">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
