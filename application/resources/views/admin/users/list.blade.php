@extends('admin.layouts.app')
@section('content')
<div class="card bg-base-100 shadow-xl">
        <div class="card-body overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>

                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr class="hover:bg-base-200/50 transition-colors">
                            <td>
                                <div class="flex items-center gap-4">
                                    <div class="avatar">
                                        <div class="h-11 w-11 rounded-full ring-2 ring-base-200 ring-offset-1 flex items-center justify-center bg-base-200 overflow-hidden">
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="object-cover">
                                            @else
                                                <span class="text-lg font-bold opacity-50">{{ substr($item->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-base-content">{{ Str::ucfirst($item->name) }}</div>
                                        <div class="text-xs text-base-content/50">User ID: #{{ $item->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-base-content/70">
                                <span class="font-medium">{{ $item->email }}</span>
                            </td>

                            <td>
                                {{ $item->phone ?? 'N/A' }}
                            </td>

                            <td>
                                @if($item->status == 1)
                                    <span class="badge badge-soft badge-success text-xs">Active</span>
                                @else
                                    <span class="badge badge-soft badge-error text-xs">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="flex gap-1 justify-end">
                                    <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-ghost btn-sm btn-square">
                                        <span class="icon-[tabler--pencil] size-5"></span>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm btn-square text-error">
                                            <span class="icon-[tabler--trash] size-5"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </table>
            <div class="mt-4 px-4 pb-4">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
