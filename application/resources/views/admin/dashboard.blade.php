@extends('admin.layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-serif font-bold text-emerald-950">Dashboard</h2>
            <p class="text-stone-500 mt-1">Welcome back! Here's an overview of your store's performance.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-4 py-2 bg-white border border-stone-200 rounded-full text-sm font-medium text-stone-600 shadow-sm">
                {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Today's Orders -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-stone-100 hover:shadow-lg transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="ti ti-shopping-cart text-xl"></i>
                </div>
                <!-- <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+12%</span> -->
            </div>
            <div>
                <p class="text-stone-500 text-sm font-medium uppercase tracking-wide">Orders Today</p>
                <h3 class="text-3xl font-bold text-emerald-950 mt-1">{{ $today_orders->count() }}</h3>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-stone-100 hover:shadow-lg transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="ti ti-clock text-xl"></i>
                </div>
            </div>
            <div>
                <p class="text-stone-500 text-sm font-medium uppercase tracking-wide">Pending</p>
                <h3 class="text-3xl font-bold text-emerald-950 mt-1">{{ $progress->count() }}</h3>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-stone-100 hover:shadow-lg transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="ti ti-package text-xl"></i>
                </div>
            </div>
            <div>
                <p class="text-stone-500 text-sm font-medium uppercase tracking-wide">Total Orders</p>
                <h3 class="text-3xl font-bold text-emerald-950 mt-1">{{ $total_orders_count }}</h3>
            </div>
        </div>

        <!-- Earned Revenue (Delivered) -->
        <div class="bg-gradient-to-br from-purple-800 to-purple-950 rounded-3xl p-6 shadow-lg text-white group hover:shadow-purple-900/30 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform">
                    <i class="ti ti-wallet text-xl"></i>
                </div>
            </div>
            <div>
                <p class="text-purple-200 text-sm font-medium uppercase tracking-wide">Earned Revenue</p>
                <h3 class="text-3xl font-bold mt-1">${{ number_format($earned_profit, 2) }}</h3>
                <p class="text-xs text-purple-300 mt-1">From delivered orders</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Revenue Chart -->
        <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-stone-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-emerald-950">Revenue Analytics</h3>
                <select class="text-sm border-none bg-stone-50 rounded-lg px-3 py-1 focus:ring-0 text-stone-600 cursor-pointer hover:bg-stone-100 transition">
                    <option>This Year</option>
                </select>
            </div>
            <div id="revenue-chart" class="w-full h-[300px]"></div>
        </div>

        <!-- Status Chart -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-100 p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-emerald-950">Order Status</h3>
            </div>
            <div class="flex items-center justify-center h-[300px]">
                <div id="order-status-chart" class="w-full"></div>
            </div>
        </div>
    </div>

    <!-- Widgets Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Top Products -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
            <div class="p-6 border-b border-stone-100">
                <h3 class="text-lg font-bold text-emerald-950">Top Selling Products</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-stone-50 text-stone-500 text-xs uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="px-6 py-4 rounded-tl-3xl">Product</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4 text-right rounded-tr-3xl">Orders</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($top_products as $product)
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-emerald-950">{{ $product->name }}</div>
                                <div class="text-xs text-stone-500">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            </td>
                             <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-stone-100 flex items-center justify-center border border-stone-200">
                                    @if($product->images->first())
                                        <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="ti ti-photo text-stone-400"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-700">{{ $product->order_items_count }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-stone-500">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- New Customers -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
            <div class="p-6 border-b border-stone-100">
                <h3 class="text-lg font-bold text-emerald-950">New Customers</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-stone-50 text-stone-500 text-xs uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="px-6 py-4 rounded-tl-3xl">Customer</th>
                            <th class="px-6 py-4 text-right rounded-tr-3xl">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($new_customers as $customer)
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-emerald-950">{{ $customer->name }}</div>
                                    <div class="text-xs text-stone-500">{{ $customer->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-xs text-stone-500">
                                {{ $customer->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                             <td colspan="2" class="px-6 py-8 text-center text-stone-500">No new customers</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-emerald-950">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-emerald-700 text-sm font-bold hover:text-emerald-800 transition">View All</a>
        </div>
        <div class="overflow-x-auto">
             <table class="w-full text-left">
                <thead class="bg-stone-50 text-stone-500 text-xs uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-3xl">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right rounded-tr-3xl">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($total_orders as $item)
                    <tr class="hover:bg-stone-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.edit', $item->id) }}" class="font-bold text-emerald-700 hover:underline">#{{ $item->order_id }}</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-emarald-950">
                            {{ $item->user->name ?? 'Guest' }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'Pending' => 'bg-amber-100 text-amber-700',
                                    'Received' => 'bg-emerald-100 text-emerald-700',
                                    'Completed' => 'bg-emerald-100 text-emerald-700',
                                    'Finalizing' => 'bg-purple-100 text-purple-700',
                                    'Canceled' => 'bg-rose-100 text-rose-700',
                                    'Invoiced' => 'bg-blue-100 text-blue-700',
                                    'Downloaded' => 'bg-stone-100 text-stone-700',
                                ];
                                $style = $statusStyles[$item->status] ?? 'bg-stone-100 text-stone-700';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $style }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-emerald-950">${{ number_format($item->price, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-stone-500">{{ dateFormat($item->created_at) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                <i class="ti ti-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                            <i class="ti ti-file-off text-3xl mb-3 block opacity-50"></i>
                            No orders found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
                 var options = {
                    series: statusValues,
                    labels: statusLabels,
                    chart: {
                        type: 'donut',
                        height: 300,
                        fontFamily: 'Inter, sans-serif'
                    },
                    colors: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: function (w) {
                                            return totalOrders;
                                        }
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    },
                    dataLabels: {
                        enabled: false
                    }
                };

                var chart = new ApexCharts(document.querySelector("#order-status-chart"), options);
                chart.render();
            }
        })();

        // --- Revenue Chart (Area) ---
        (function() {
            const revenueData = @json($revenueData ?? []);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var options = {
                series: [{
                    name: "Revenue",
                    data: revenueData
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    fontFamily: 'Inter, sans-serif',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
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
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                colors: ['#3b82f6'] // Primary Blue
            };

            var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
            chart.render();
        })();
    });
</script>
@endpush