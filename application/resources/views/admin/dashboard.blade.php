@extends('admin.layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">Dashboard</h2>
    <div style="font-size: 0.875rem; color: var(--text-muted);">Welcome back! Here's what's happening with your store today.</div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Today's Orders -->
    <div class="card" style="border-left: 4px solid var(--primary);">
        <div class="card-body" style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.875rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Orders Today</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin-top: 4px;">{{ $today_orders->count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; background: rgba(var(--primary-rgb), 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                <i class="ti ti-shopping-cart" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>

    <!-- Pending Orders -->
    <div class="card" style="border-left: 4px solid var(--warning);">
        <div class="card-body" style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.875rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Pending</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin-top: 4px;">{{ $progress->count() }}</div>
            </div>
            <div style="width: 48px; height: 48px; background: rgba(var(--warning-rgb), 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--warning);">
                <i class="ti ti-clock" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="card" style="border-left: 4px solid var(--info);">
        <div class="card-body" style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.875rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Total Orders</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin-top: 4px;">{{ $total_orders_count }}</div>
            </div>
            <div style="width: 48px; height: 48px; background: rgba(var(--info-rgb), 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--info);">
                <i class="ti ti-package" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="card" style="border-left: 4px solid var(--success);">
        <div class="card-body" style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.875rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Total Revenue</div>
                <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin-top: 4px;">${{ number_format(\App\Models\Order::where('is_paid', true)->sum('price'), 2) }}</div>
            </div>
            <div style="width: 48px; height: 48px; background: rgba(var(--success-rgb), 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--success);">
                <i class="ti ti-currency-dollar" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    <!-- Revenue Chart -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Revenue Analytics</span>
        </div>
        <div class="card-body">
            <div id="revenue-chart" style="width: 100%; height: 300px;"></div>
        </div>
    </div>

    <!-- Status Chart -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Order Status</span>
        </div>
        <div class="card-body" style="display: flex; align-items: center; justify-content: center;">
            <div id="order-status-chart" style="width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Widgets Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Top Products -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Top Selling Products</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">Image</th>
                        <th>Product Name</th>
                        <th style="text-align: right;">Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($top_products as $product)
                    <tr>
                        <td>
                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                @if($product->images->first())
                                    <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="ti ti-photo" style="color: var(--text-muted);"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);">{{ $product->name }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $product->category->name ?? 'Uncategorized' }}</div>
                        </td>
                        <td style="text-align: right; font-weight: 700; color: var(--text-main);">{{ $product->order_items_count }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 20px;">No data available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- New Customers -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">New Customers</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    @forelse($new_customers as $customer)
                    <tr>
                        <td width="50">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                {{ substr($customer->name, 0, 1) }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);">{{ $customer->name }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $customer->email }}</div>
                        </td>
                        <td style="text-align: right; font-size: 0.75rem; color: var(--text-muted);">
                            {{ $customer->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                         <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 20px;">No new customers</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="card-header">
        <span class="card-title">Recent Orders</span>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div class="table-responsive">
         <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($total_orders as $item)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.edit', $item->id) }}" style="font-weight: 600; color: var(--primary);">#{{ $item->order_id }}</a>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ $item->user->name ?? 'Guest' }}</div>
                    </td>
                    <td>
                        @php
                            $statusClass = 'badge-primary';
                            if(in_array($item->status, ['Received', 'Completed', 'Finalizing'])) $statusClass = 'badge-success';
                            elseif($item->status == 'Canceled') $statusClass = 'badge-danger';
                            elseif($item->status == 'Invoiced') $statusClass = 'badge-info';
                            elseif($item->status == 'Downloaded') $statusClass = 'badge-secondary';
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $item->status }}</span>
                    </td>
                    <td style="font-weight: 600;">${{ $item->price }}</td>
                    <td style="font-size: 0.75rem; color: var(--text-muted);">{{ dateFormat($item->created_at) }}</td>
                    <td style="text-align: right;">
                        <a href="{{ route('admin.orders.edit', $item->id) }}" class="btn btn-outline btn-icon" style="padding: 4px 8px;">
                            <i class="ti ti-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <i class="ti ti-file-off" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 8px;"></i>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">No orders found</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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