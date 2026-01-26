@extends('panel.layouts.app')

@section('content')
    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Left Column: Identity & Personal Info --}}
        <div class="flex flex-col gap-6 md:flex-row xl:flex-col">

            <!-- User Identity Card -->
            <div class="card shadow-base-300/10 grow shadow-md">

                <div class="card-body items-center text-center">
                    <div class="avatar mb-4">
                        <div class="size-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ $user->user_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff' }}"
                                alt="{{ $user->name }}" class="rounded-full object-cover" />
                        </div>
                    </div>

                    <h5 class="text-xl font-bold text-base-content">{{ $user->name }}</h5>
                    <p class="text-base-content/60 mb-4">{{ $user->email }}</p>

                    <div class="w-full flex justify-between items-center py-2 border-b border-base-content/10">
                        <span class="text-base-content/70">Role</span>
                        <span class="font-medium">{{ $user->is_admin ? 'Admin' : 'User' }}</span>
                    </div>
                    <div class="w-full flex justify-between items-center py-2 border-b border-base-content/10">
                        <span class="text-base-content/70">User ID</span>
                        <span class="badge badge-soft badge-error font-bold">{{ $user->userDetail?->uuid }}</span>

                    </div>
                    <div class="w-full flex justify-between items-center py-2 border-b border-base-content/10">
                        <span class="text-base-content/70">Joined</span>
                        <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="w-full flex justify-between items-center py-2">
                        <span class="text-base-content/70">Status</span>
                        @if ($user->status == 1)
                            <span class="badge badge-soft badge-primary">Active</span>
                        @elseif($user->status == 2)
                            <span class="badge badge-soft badge-error">Banned</span>
                        @else
                            <span class="badge badge-soft badge-warning">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Personal Information Card -->
            <div class="card shadow-base-300/10 grow shadow-md">
                <div class="card-body">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="avatar placeholder">
                            <div class="bg-primary/10 text-primary rounded-full size-12">
                                <span class="icon-[tabler--user-check] size-6"></span>
                            </div>
                        </div>
                        <h2 class="card-title text-xl">Address Details</h2>
                    </div>

                    <div class="grid gap-4">
                        <!-- Phone -->
                        <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                            <div class="avatar avatar-placeholder">
                                <div class="bg-warning/20 text-warning rounded-field size-11.5">
                                    <span class="icon-[tabler--phone] size-6.5"></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base-content/50 text-sm font-medium">Phone Number</span>
                                <span class="text-base-content text-sm font-semibold truncate">
                                    {{ $user->userDetail?->phone ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                            <div class="avatar avatar-placeholder">
                                <div class="text-success bg-success/20 rounded-field size-11.5">
                                    <span class="icon-[tabler--map-pin] size-6.5"></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base-content/50 text-sm font-medium">Address</span>
                                <span class="text-base-content text-sm font-semibold truncate">
                                    {{ $user->userDetail?->address ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- City/State -->
                        <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                            <div class="avatar avatar-placeholder">
                                <div class="text-primary bg-primary/20 rounded-field size-11.5">
                                    <span class="icon-[tabler--building] size-6.5"></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base-content/50 text-sm font-medium">City / State</span>
                                <span class="text-base-content text-sm font-semibold truncate">
                                    {{ $user->userDetail?->city ?? '-' }} / {{ $user->userDetail?->state ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                            <div class="avatar avatar-placeholder">
                                <div class="text-accent bg-accent/20 rounded-field size-11.5">
                                    <span class="icon-[tabler--flag] size-6.5"></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base-content/50 text-sm font-medium">Country</span>
                                <span class="text-base-content text-sm font-semibold truncate">
                                    {{ $user->userDetail?->country->name ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Order Stats --}}
        <div class="card shadow-base-300/10 shadow-md xl:col-span-2">
            <div class="card-header">
                <h3 class="card-title text-xl font-medium">Order Summary</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- Total Orders --}}
                    <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                        <div class="avatar avatar-placeholder">
                            <div class="text-primary bg-primary/20 rounded-field size-11.5">
                                <span class="icon-[tabler--shopping-cart] size-6.5"></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base-content/50 text-sm font-medium">Total Orders</span>
                            <span class="text-base-content text-lg font-semibold truncate">{{ $totalOrders }}</span>
                        </div>
                    </div>

                    {{-- Dynamic Statuses --}}
                    @foreach ($stats as $status => $count)
                        @php
                            $style = match ($status) {
                                'Pending', 'In Review' => [
                                    'color' => 'text-warning',
                                    'bg' => 'bg-warning/20',
                                    'icon' => 'icon-[tabler--clock]',
                                ],
                                'Processing' => [
                                    'color' => 'text-info',
                                    'bg' => 'bg-info/20',
                                    'icon' => 'icon-[tabler--loader]',
                                ],
                                'Completed', 'Received', 'Finalizing', 'Downloaded' => [
                                    'color' => 'text-success',
                                    'bg' => 'bg-success/20',
                                    'icon' => 'icon-[tabler--check]',
                                ],
                                'Invoiced' => [
                                    'color' => 'text-secondary',
                                    'bg' => 'bg-secondary/20',
                                    'icon' => 'icon-[tabler--file-invoice]',
                                ],
                                'Canceled' => [
                                    'color' => 'text-error',
                                    'bg' => 'bg-error/20',
                                    'icon' => 'icon-[tabler--x]',
                                ],
                                default => [
                                    'color' => 'text-base-content',
                                    'bg' => 'bg-base-content/10',
                                    'icon' => 'icon-[tabler--box]',
                                ],
                            };
                        @endphp
                        <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                            <div class="avatar avatar-placeholder">
                                <div class="{{ $style['color'] }} {{ $style['bg'] }} rounded-field size-11.5">
                                    <span class="{{ $style['icon'] }} size-6.5"></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base-content/50 text-sm font-medium">{{ $status }}</span>
                                <span class="text-base-content text-lg font-semibold truncate">{{ $count }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Payment Summary --}}
                <div class="card-header border-t border-base-content/10 mt-6 pt-6">
                    <h3 class="card-title text-xl font-medium">Payment Summary</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                    {{-- Paid Orders --}}
                    <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                        <div class="avatar avatar-placeholder">
                            <div class="text-success bg-success/20 rounded-field size-11.5">
                                <span class="icon-[tabler--wallet] size-6.5"></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base-content/50 text-sm font-medium">Paid Orders</span>
                            <span class="text-base-content text-lg font-semibold truncate">{{ $paidOrdersCount }}</span>
                        </div>
                    </div>

                    {{-- Unpaid Orders --}}
                    <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                        <div class="avatar avatar-placeholder">
                            <div class="text-error bg-error/20 rounded-field size-11.5">
                                <span class="icon-[tabler--credit-card-off] size-6.5"></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base-content/50 text-sm font-medium">Unpaid Orders</span>
                            <span class="text-base-content text-lg font-semibold truncate">{{ $unpaidOrdersCount }}</span>
                        </div>
                    </div>

                    {{-- Total Spent --}}
                    <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                        <div class="avatar avatar-placeholder">
                            <div class="text-primary bg-primary/20 rounded-field size-11.5">
                                <span class="icon-[tabler--currency-dollar] size-6.5"></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base-content/50 text-sm font-medium">Total Spent</span>
                            <span
                                class="text-base-content text-lg font-semibold truncate">${{ number_format($totalSpent, 2) }}</span>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection
