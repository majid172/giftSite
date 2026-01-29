@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <!-- Header -->
    <div class="kartly-title">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--receipt] size-6"></span>
            Order Details
        </div>
        <a href="{{ route('admin.orders.index') }}" class="back-btn">
            <span class="icon-[tabler--arrow-left] size-4.5"></span>
            Back
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content: Order Details -->
        <div class="w-full lg:w-2/3">
            <div class="section-card">
                <div class="card-header border-b-0 pb-0">
                    <h3 class="text-lg font-bold text-slate-800">Order Details</h3>
                </div>
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-slate-500 text-sm border-b border-slate-100">
                                    <th class="py-4 font-medium">S. No.</th>
                                    <th class="py-4 font-medium">Products</th>
                                    <th class="py-4 font-medium">Quantity</th>
                                    <th class="py-4 font-medium">Unit Cost</th>
                                    <th class="py-4 font-medium">Discount</th>
                                    <th class="py-4 font-medium text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-700 text-sm">
                                @foreach($order->items as $index => $item)
                                <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50">
                                    <td class="py-4">{{ $index + 1 }}</td>
                                    <td class="py-4 font-semibold">{{ $item->product_name }}</td>
                                    <td class="py-4">{{ $item->quantity }}</td>
                                    <td class="py-4">${{ number_format($item->price, 2) }}</td>
                                    <td class="py-4">0%</td>
                                    <td class="py-4 text-right font-medium">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-8 flex justify-end">
                        <div class="w-full max-w-xs space-y-3">
                            <h4 class="font-bold text-slate-800 text-right mb-4">Order summary</h4>
                            <div class="flex justify-between text-sm text-slate-600">
                                <span>Sub Total</span>
                                <span class="font-medium">${{ number_format($order->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-slate-600">
                                <span>Shipping</span>
                                <span class="font-medium">$0.00</span> <!-- Replace with actual logic if available -->
                            </div>
                            <div class="flex justify-between text-sm text-slate-600">
                                <span>Tax</span>
                                <span class="font-medium">$0.00</span>
                            </div>
                            <div class="border-t border-slate-200 mt-2 pt-2 flex justify-between text-base font-bold text-slate-800">
                                <span>Total</span>
                                <span>${{ number_format($order->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Customer & Status -->
        <div class="w-full lg:w-1/3 space-y-6">
            
            <!-- Customer Details (Matches Image) -->
            <div class="section-card">
                <div class="card-header border-b-0 pb-0">
                    <h3 class="text-lg font-bold text-slate-800">Customer Details</h3>
                </div>
                <div class="card-body">
                    <div class="flex flex-col">
                        <!-- Name -->
                        <div class="flex justify-between py-4 border-b border-slate-100">
                            <span class="text-sm text-slate-500 font-medium">Name</span>
                            <span class="text-sm text-slate-700 font-semibold text-right">{{ $order->user ? $order->user->name : 'Guest' }}</span>
                        </div>
                         <!-- Email -->
                        <div class="flex justify-between py-4 border-b border-slate-100">
                            <span class="text-sm text-slate-500 font-medium">Email</span>
                            <span class="text-sm text-slate-700 text-right">{{ $order->shipping_address['email'] ?? 'N/A' }}</span>
                        </div>
                         <!-- Phone -->
                        <div class="flex justify-between py-4 border-b border-slate-100">
                            <span class="text-sm text-slate-500 font-medium">Phone</span>
                            <span class="text-sm text-slate-700 text-right">{{ $order->shipping_address['phone'] ?? 'N/A' }}</span>
                        </div>
                         <!-- Country -->
                        <div class="flex justify-between py-4 border-b border-slate-100">
                            <span class="text-sm text-slate-500 font-medium">Country</span>
                            <span class="text-sm text-slate-700 text-right">{{ $order->shipping_address['country'] ?? 'USA' }}</span>
                        </div>
                         <!-- Address -->
                        <div class="flex justify-between py-4">
                            <span class="text-sm text-slate-500 font-medium shrink-0">Address</span>
                            <span class="text-sm text-slate-700 text-right max-w-[200px]">
                                {{ $order->shipping_address['address'] ?? '' }}, {{ $order->shipping_address['city'] ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update (Essential Functionality) -->
            <div class="section-card">
                <div class="card-header">
                    <span>Order Status</span>
                </div>
                <div class="card-body">
                     <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <select name="status" class="form-control">
                                @foreach(['Pending', 'Processing', 'Shipped', 'Completed', 'Canceled', 'Finalizing'] as $status)
                                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="save-btn w-full justify-center">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
