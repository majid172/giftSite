@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    
    <!-- Header -->
    <div class="kartly-title">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--receipt] size-6"></span>
            <div class="flex flex-col">
                <span class="text-xl font-bold text-slate-800">Order #{{ $order->order_id ?? $order->id }}</span>
                <span class="text-xs text-slate-500 font-normal">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="back-btn" title="Print Invoice">
                <span class="icon-[tabler--printer] size-4"></span>
                Invoice
            </a>
            <a href="{{ route('admin.orders.index') }}" class="back-btn">
                <span class="icon-[tabler--arrow-left] size-4"></span>
                Back
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2 shadow-sm" role="alert">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- Left Column: Order Items, Status & Totals -->
        <div class="w-full lg:w-2/3">
            <div class="section-card">
                <div class="card-header border-b border-slate-100 flex justify-between items-center">
                    <span>Order Details</span>
                    <span class="cart-badge">{{ $order->items->count() }} Items</span>
                </div>
                <div class="card-body p-0">
                    <!-- Items Table -->
                    <div class="overflow-x-auto">
                        <table class="custom-table w-full text-left">
                            <thead>
                                <tr>
                                    <th class="pl-6">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right pr-6">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="pl-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-lg bg-stone-100 border border-stone-200 flex-shrink-0 overflow-hidden">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-stone-400">
                                                        <span class="icon-[tabler--photo] w-5 h-5"></span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800 line-clamp-1">{{ $item->product_name }}</p>
                                                <p class="text-xs text-slate-500 mt-0.5">SKU: {{ $item->product_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-slate-600 font-medium">${{ number_format($item->price, 2) }}</td>
                                    <td class="text-center text-slate-600">{{ $item->quantity }}</td>
                                    <td class="text-right pr-6 font-bold text-emerald-700">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Status & Totals Section -->
                    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                        <div class="flex flex-col md:flex-row gap-8 justify-between items-start">
                            
                            <!-- Status Change (Left Side) -->
                            <div class="w-full md:w-1/2">
                                <label class="form-label mb-3" for="status">Update Order Status</label>
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative flex-grow">
                                        <select name="status" id="status" class="form-control appearance-none bg-white">
                                            @foreach(['Pending', 'Processing', 'Shipped', 'Completed', 'Canceled', 'Finalizing'] as $status)
                                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                    <button type="submit" class="save-btn px-4 py-2 text-sm whitespace-nowrap">Update</button>
                                </form>
                            </div>

                            <!-- Totals (Right Side) -->
                            <div class="w-full md:w-1/2 space-y-3">
                                <div class="flex justify-between text-slate-600 text-sm">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-slate-900">${{ number_format($order->price - $order->shipping_cost, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-slate-600 text-sm">
                                    <span>Shipping</span>
                                    <span class="font-bold text-slate-900">${{ number_format($order->shipping_cost, 2) }}</span>
                                </div>
                                <div class="border-t border-slate-200 pt-3 flex justify-between items-end">
                                    <span class="text-base font-bold text-slate-800">Total</span>
                                    <span class="text-2xl font-bold text-emerald-700">${{ number_format($order->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Customer Details -->
        <div class="w-full lg:w-1/3">
            <div class="section-card">
                <div class="card-header border-b border-slate-100 flex justify-between items-center">
                   <span>Customer Details</span>
                   <span class="text-xs font-semibold px-2 py-1 rounded bg-slate-100 text-slate-600 border border-slate-200">
                       {{ $order->user ? 'Registered' : 'Guest' }}
                   </span>
                </div>
                
                <div class="card-body">
                    <!-- Avatar & Identity -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden flex-shrink-0">
                            @if($order->user && $order->user->image)
                                <img src="{{ asset($order->user->image) }}" alt="{{ $order->user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold">{{ substr($order->user ? $order->user->name : 'G', 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">{{ $order->user ? $order->user->name : 'Guest Customer' }}</h3>
                            <p class="text-sm text-slate-500">{{ $order->shipping_address['email'] ?? 'No Email' }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">ID: #{{ $order->user_id ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Info List -->
                    <div class="space-y-4">
                        
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded flex items-center justify-center bg-white border border-slate-200 text-slate-500 flex-shrink-0">
                                <span class="icon-[tabler--phone] size-4"></span>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wide">Phone</label>
                                <p class="text-sm font-medium text-slate-700">{{ $order->shipping_address['phone'] ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded flex items-center justify-center bg-white border border-slate-200 text-slate-500 flex-shrink-0">
                                <span class="icon-[tabler--calendar] size-4"></span>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wide">Joined</label>
                                <p class="text-sm font-medium text-slate-700">{{ $order->user ? $order->user->created_at->format('M Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded flex items-center justify-center bg-white border border-slate-200 text-slate-500 flex-shrink-0">
                                <span class="icon-[tabler--map-pin] size-4"></span>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wide">Shipping Address</label>
                                <p class="text-sm font-medium text-slate-700 leading-snug">
                                    {{ $order->shipping_address['address'] ?? '' }}
                                    @if(isset($order->shipping_address['city']))
                                        <br>
                                        {{ $order->shipping_address['city'] ?? '' }} 
                                        {{ isset($order->shipping_address['zip']) ? '- ' . $order->shipping_address['zip'] : '' }}
                                    @endif
                                    <br>
                                    <span class="text-slate-900 font-semibold">{{ $order->shipping_address['country'] ?? 'USA' }}</span>
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                        <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                            View Full Profile
                            <span class="icon-[tabler--arrow-right] size-3"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Main Layout */
    .kartly-settings-container {
        padding: 2rem;
        max-width: 1280px;
        margin: 0 auto;
    }

    .kartly-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    /* Buttons */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background-color: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .back-btn:hover {
        background-color: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        color: #0f172a;
    }

    /* General Cards */
    .section-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        color: #1e293b;
        font-size: 1.125rem;
        background-color: transparent;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Order Details Table */
    .cart-badge {
        background-color: #f1f5f9;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
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
    }

    .custom-table td {
        padding: 1.25rem 0.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    /* Form Elements */
    .form-group { margin-bottom: 1rem; }
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #cbd5e1;
        background-color: white;
        color: #1e293b;
        font-weight: 500;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    .save-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
    }
    .save-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 8px -1px rgba(16, 185, 129, 0.4);
    }
</style>
@endsection
