@extends('admin.layouts.app')

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title">
        <div class="flex items-center gap-2">
            <span class="icon-[tabler--dashboard] size-6"></span>
            Dashboard
        </div>
        <div class="text-sm text-slate-500 font-normal">
            Overview of your store's performance
        </div>
    </div>

    <!-- 1. Key Metrics Grid -->
    <div class="flex flex-col xl:flex-row gap-6 mb-8">
        <!-- Today's Orders -->
        <div class="section-card flex-1 transition-transform hover:-translate-y-1 duration-300">
            <div class="card-body p-6 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                        <span class="icon-[tabler--shopping-cart] size-6"></span>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ $today_orders->count() }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Orders Today</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="section-card flex-1 transition-transform hover:-translate-y-1 duration-300">
            <div class="card-body p-6 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <span class="icon-[tabler--clock] size-6"></span>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ $progress->count() }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Pending Orders</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="section-card flex-1 transition-transform hover:-translate-y-1 duration-300">
            <div class="card-body p-6 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                        <span class="icon-[tabler--package] size-6"></span>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ $total_orders_count }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Total Orders</p>
                </div>
            </div>
        </div>

        <!-- Total Sales -->
        <div class="section-card flex-1 transition-transform hover:-translate-y-1 duration-300">
            <div class="card-body p-6 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                        <span class="icon-[tabler--currency-dollar] size-6"></span>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-slate-800 mb-1">${{ number_format(\App\Models\Order::where('is_paid', true)->sum('price'), 2) }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Total Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Analytics (Area Chart) -->
        <div class="section-card xl:col-span-2 flex flex-col">
            <div class="card-header justify-between">
                <div>
                    <span>Revenue Analytics</span>
                    <span class="text-xs font-normal text-slate-500 hidden sm:inline-block ml-2">- Monthly Performance ({{ date('Y') }})</span>
                </div>
                <div class="flex gap-2">
                     <span class="badge badge-blue">Sales</span>
                </div>
            </div>
            <div class="card-body">
                <div id="revenue-chart" class="w-full h-[300px]"></div>
            </div>
        </div>

        <!-- Order Status Distribution (Donut Chart) -->
        <div class="section-card xl:col-span-1 flex flex-col">
            <div class="card-header">
                <span>Order Status</span>
            </div>
            <div class="card-body flex flex-col items-center justify-center h-full">
                <div id="order-status-chart" class="w-full"></div>
            </div>
        </div>
    </div>

    <!-- 3. Widgets Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Top Selling Products -->
        <div class="section-card h-full flex flex-col">
            <div class="card-header">
                <span>Top Products</span>
            </div>
            <div class="card-body p-0 overflow-y-auto max-h-[400px]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Product</th>
                            <th class="px-4 py-3 font-semibold text-right">Orders</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($top_products as $product)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200">
                                        @if($product->images->first())
                                            <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                             <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                <span class="icon-[tabler--photo] size-5"></span>
                                             </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-700 line-clamp-1" title="{{ $product->name }}">{{ $product->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right font-bold text-slate-700">
                                {{ $product->order_items_count }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-4 py-8 text-center text-sm text-slate-400">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- New Customers -->
        <div class="section-card h-full flex flex-col">
            <div class="card-header">
                <span>New Customers</span>
            </div>
            <div class="card-body p-0 overflow-y-auto max-h-[400px]">
                <ul class="divide-y divide-slate-100">
                    @forelse($new_customers as $customer)
                    <li class="p-4 hover:bg-slate-50/50 transition-colors flex items-center gap-3">
                        <div class="avatar placeholder">
                            <div class="bg-indigo-50 text-indigo-600 rounded-full w-10 h-10 flex items-center justify-center font-bold text-sm">
                                {{ substr($customer->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-semibold text-slate-700">{{ $customer->name }}</div>
                            <div class="text-xs text-slate-500">{{ $customer->email }}</div>
                        </div>
                        <div class="text-xs text-slate-400">
                            {{ $customer->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </li>
                    @empty
                    <li class="p-8 text-center text-sm text-slate-400">No new customers</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- 4. Recent Orders Table -->
    <div class="section-card">
        <div class="card-header justify-between">
            <div>
                <span>Recent Orders</span>
                <span class="text-xs font-normal text-slate-500 hidden sm:inline-block">- Latest 5 transactions</span>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                View All <span class="icon-[tabler--arrow-right] size-4"></span>
            </a>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($total_orders as $item)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.edit', $item->id) }}" class="font-bold text-blue-700 hover:text-blue-900">
                                    #{{ $item->order_id }}
                                </a>
                            </td>
                            <td>
                                <div class="font-medium text-slate-700">{{ $item->user->name ?? 'Guest' }}</div>
                            </td>
                            <td>
                                @php
                                    $statusClass = 'badge-blue';
                                    if(in_array($item->status, ['Received', 'Completed', 'Finalizing'])) $statusClass = 'badge-green';
                                    elseif($item->status == 'Canceled') $statusClass = 'badge-red';
                                    elseif($item->status == 'Invoiced') $statusClass = 'badge-blue';
                                    elseif($item->status == 'Downloaded') $statusClass = 'badge-gray';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $item->status }}</span>
                            </td>
                            <td class="font-bold text-slate-800">${{ $item->price }}</td>
                            <td class="text-slate-500 text-xs">{{ dateFormat($item->created_at) }}</td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.orders.edit', $item->id) }}" class="action-btn" title="View Details">
                                        <span class="icon-[tabler--eye] size-4.5"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="icon-[tabler--file-off] size-8 text-slate-300"></span>
                                    <span class="text-slate-500 font-medium">No orders found</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    window.addEventListener('load', () => {
        // --- Order Status Chart (Donut) ---
        (function() {
            const statusLabels = @json($statusLabels ?? []);
            const statusValues = @json($statusValues ?? []);
            
            if(statusValues.length > 0) {
                 const totalOrders = statusValues.reduce((a, b) => a + b, 0);
                 buildChart('#order-status-chart', () => ({
                    chart: {
                        height: 280,
                        width: '100%',
                        type: 'donut',
                        fontFamily: 'Inter, ui-sans-serif',
                    },
                    labels: statusLabels,
                    series: statusValues,
                    colors: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'],
                    stroke: { show: false },
                    dataLabels: { enabled: false },
                    legend: {
                        show: true,
                        position: 'bottom',
                        markers: { radius: 12 },
                        itemMargin: { horizontal: 10, vertical: 5 }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    name: { fontSize: '12px', color: '#64748b' },
                                    value: {
                                        fontSize: '24px',
                                        fontWeight: 700,
                                        color: '#0f172a',
                                        formatter: function(val) { return parseInt(val); }
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        color: '#64748b',
                                        formatter: function(w) { return totalOrders; }
                                    }
                                }
                            }
                        }
                    }
                }));
            }
        })();

        // --- Revenue Chart (Area) ---
        (function() {
            const revenueData = @json($revenueData ?? []);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            buildChart('#revenue-chart', () => ({
                chart: {
                    height: 300,
                    type: 'area',
                    fontFamily: 'Inter, ui-sans-serif',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                series: [{
                    name: 'Revenue',
                    data: revenueData
                }],
                colors: ['#3b82f6'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: months,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '12px' }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '12px' },
                        formatter: (val) => { return '$' + val }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } },
                    xaxis: { lines: { show: false } },
                    padding: { top: 0, right: 0, bottom: 0, left: 10 }
                },
                tooltip: {
                    y: { formatter: function (val) { return "$" + val } }
                }
            }));
        })();
    });
</script>
@endpush