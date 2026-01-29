@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title justify-between">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--users] size-6"></span>
            User Management
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2 shadow-sm" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="section-card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th width="80">Avatar</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>
                                <div class="table-img-wrapper">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="table-img rounded-full" />
                                    @else
                                        <div class="table-img rounded-full flex items-center justify-center text-slate-400 bg-slate-100">
                                            <span class="font-bold text-lg">{{ substr($item->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="font-semibold text-slate-700">{{ Str::ucfirst($item->name) }}</div>
                                <div class="text-xs text-slate-400">ID: #{{ $item->id }}</div>
                            </td>
                            <td>
                                <span class="text-slate-600 font-medium">{{ $item->email }}</span>
                            </td>
                            <td>
                                <span class="text-slate-600">{{ $item->phone ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge badge-green">Active</span>
                                @else
                                    <span class="badge badge-red">Inactive</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.users.edit', $item->id) }}" class="action-btn" title="Edit">
                                        <span class="icon-[tabler--pencil] size-4.5"></span>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete">
                                            <span class="icon-[tabler--trash] size-4.5"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                        <span class="icon-[tabler--users-off] size-8"></span>
                                    </div>
                                    <div class="text-slate-500 font-medium">No users found</div>
                                    <p class="text-sm text-slate-400">There are no registered users matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Custom CSS to match Product List Design */
    .kartly-settings-container {
        padding: 2rem;
        max-width: 1280px;
        margin: 0 auto;
    }

    .kartly-title {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .section-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        padding: 1rem 1.5rem;
        font-weight: 700;
        color: #1e293b;
        font-size: 1.125rem;
        background-color: transparent;
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-body {
        padding: 0;
    }

    /* Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th {
        padding: 1rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }
    
    .custom-table th:first-child, .custom-table td:first-child { padding-left: 1.5rem; }
    .custom-table th:last-child, .custom-table td:last-child { padding-right: 1.5rem; }

    .custom-table td {
        padding: 1rem 0.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    /* Images */
    .table-img {
        width: 3rem;
        height: 3rem;
        object-fit: cover;
        border-radius: 0.5rem; /* Default for products, but overridden inline for users if needed */
        border: 1px solid #e2e8f0;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1;
    }
    .badge-gray { background-color: #f1f5f9; color: #475569; }
    .badge-green { background-color: #d1fae5; color: #065f46; }
    .badge-red { background-color: #fee2e2; color: #991b1b; }

    /* Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        color: #64748b;
        transition: all 0.2s;
    }
    .action-btn:hover { background-color: #f1f5f9; color: #0f172a; }
    .action-btn.delete:hover { background-color: #fef2f2; color: #ef4444; }


</style>
@endsection
