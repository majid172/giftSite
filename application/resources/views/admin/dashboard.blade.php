@extends('admin.layouts.app')
@section('content')
    <div class="shadow-base-300/10 rounded-box bg-base-100 flex gap-4 p-6 shadow-md max-xl:flex-col">
        <div class="flex flex-1 gap-4 max-sm:flex-col">
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--eye] size-5"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Today's Order</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold text-success">{{ $today_orders->count() }}</div>
                    {{-- <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">EPC: 308.20</span>
                    </div> --}}
                </div>
            </div>
            <div class="divider sm:divider-horizontal"></div>
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--mouse] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Order Progress</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold text-error">{{ $progress->count() }}</div>
                    {{-- <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-error inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-down] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 77,359</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="divider xl:divider-horizontal"></div>
        <div class="flex flex-1 gap-4 max-sm:flex-col">
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--chart-bar] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Total Orders</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold text-success">{{ $total_orders->count() }}</div>
                    {{-- <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 77,359</span>
                    </div> --}}
                </div>
            </div>
            <div class="divider sm:divider-horizontal"></div>
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--currency-dollar] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Sales</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold">22</div>
                    {{-- <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 13.85</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <div class="flex flex-col gap-6 md:flex-row xl:flex-col">
            <!-- Meeting Schedules -->
            <div class="card shadow-base-300/10 grow shadow-md">
                <div class="card-header flex items-center justify-between gap-2">
                    <h4 class="card-title text-xl">Latest Notices</h4>
                    <div class="dropdown relative inline-flex">
                        <button id="dropdown-meeting-schedules" type="button"
                            class="dropdown-toggle btn btn-text text-base-content/50 btn-circle btn-sm" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="icon-[tabler--dots-vertical] size-5.5"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-meeting-schedules">
                            <li><a class="dropdown-item" href="#">Last 28 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="flex h-full flex-col justify-between gap-3">
                        @forelse ($notices as $item)
                            <li class="py-1">
                                <div class="flex items-start gap-3">
                                    <!-- Icon Container -->
                                    <div class="avatar placeholder">
                                        <div
                                            class="bg-blue-50 text-blue-600 rounded-full size-10 flex items-center justify-center">
                                            <!-- You can swap this icon based on the update type -->
                                            <span class="icon-[tabler--bell] size-5"></span>
                                        </div>
                                    </div>

                                    <div class="grow">
                                        <h6 class="text-base-content font-medium text-sm leading-snug">
                                            {{ $item->title }}
                                        </h6>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span
                                                class="text-xs font-medium bg-base-200 px-2 py-0.5 rounded text-base-content/70">
                                                {{ dateFormat($item->publish_date) }}
                                            </span>
                                            <span class="text-[10px] text-base-content/40">•</span>
                                            <span class="text-xs text-base-content/50">Update</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="rounded-field size-10">
                                            <img src="../assets/img/avatars/1.png" alt="avatar" />
                                        </div>
                                    </div>

                                    <div class="grow">
                                        <h6 class="text-base-content mb-px font-medium">Empty Notice</h6>
                                        <div class="text-base-content/50 flex items-center gap-1 text-sm">
                                            <span class="icon-[tabler--calendar] size-4.5"></span>
                                            <span>No data found</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-primary badge-soft rounded-field font-medium">Empty</span>
                                </div>
                            </li>
                        @endforelse


                    </ul>
                </div>
            </div>

            <!-- Students By Countries -->
            <div class="card shadow-base-300/10 shadow-md">
                <div class="card-header flex items-start justify-between gap-2">
                    <div>
                        <h4 class="card-title text-lg">User by Countries</h4>

                    </div>
                    <div class="dropdown relative inline-flex">

                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-students-by-countries">
                            <li><a class="dropdown-item" href="#">Last 28 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="flex h-full flex-col justify-between gap-6">
                        @foreach ($countries as $item)
                            <li>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="size-11 rounded-full">
                                            <img src="data:image/jpeg;base64,{{ base64_encode($item->country?->image) }}"
                                                alt="united states flag" />
                                        </div>
                                    </div>

                                    <div class="grow">
                                        <div class="flex items-center gap-2.5">
                                            <h6 class="text-base-content font-semibold">{{ $item->total }}</h6>
                                            {{-- <div class="text-error flex items-center">
                                            <span class="icon-[tabler--chevron-down] size-4"></span>
                                            <p class="text-sm">7.0%</p>
                                        </div> --}}
                                        </div>
                                        <p class="text-base-content/50 text-sm">{{ $item->country?->name }}</p>
                                    </div>


                                </div>
                            </li>
                        @endforeach


                        {{-- <li>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="size-11 rounded-full">
                                        <img src="../assets/img/canada.png" alt="canada flag" />
                                    </div>
                                </div>

                                <div class="grow">
                                    <div class="flex items-center gap-2.5">
                                        <h6 class="text-base-content font-semibold">112k</h6>
                                        <div class="text-success flex items-center">
                                            <span class="icon-[tabler--chevron-up] size-4"></span>
                                            <p class="text-sm">6.3%</p>
                                        </div>
                                    </div>
                                    <p class="text-base-content/50 text-sm">Canada</p>
                                </div>

                                <div>
                                    <span class="text-base-content font-medium">227k</span>
                                    <span class="text-base-content/50 text-sm">/new</span>
                                </div>
                            </div>
                        </li> --}}


                    </ul>
                </div>
            </div>
        </div>

        <!-- Sales Metrics -->
        <div class="card shadow-base-300/10 shadow-md xl:col-span-2">
            <div class="card-body gap-6">
                <div class="flex w-full items-start gap-6 max-md:flex-col">
                    <div class="gap-7.5 flex grow flex-col max-md:w-full">
                        <h2 class="card-title text-xl">Order Chart</h2>

                        <!-- Company Info -->
                        <div class="grid gap-4 sm:grid-cols-1">
                            <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                                <div class="avatar avatar-placeholder">
                                    <div class="bg-warning/20 text-warning rounded-field size-11.5">
                                        <span class="icon-[tabler--trending-up] size-6.5"></span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-base-content/50 text-sm font-medium">Total Sales</span>
                                    <span class="text-base-content text-lg font-semibold">$22</span>
                                </div>
                            </div>
                            <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                                <div class="avatar avatar-placeholder">
                                    <div class="text-success bg-success/20 rounded-field size-11.5">
                                        <span class="icon-[tabler--chart-bar] size-6.5"></span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-base-content/50 text-sm font-medium">Total Profit</span>
                                    <span class="text-base-content text-lg font-semibold">$33</span>
                                </div>
                            </div>
                            <!-- <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                                <div class="avatar avatar-placeholder">
                                    <div class="text-primary bg-primary/20 rounded-field size-11.5">
                                        <span class="icon-[tabler--discount-2] size-6.5"></span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-base-content/50 text-sm font-medium">Discounts</span>
                                    <span class="text-base-content text-lg font-semibold">$00</span>
                                </div>
                            </div> -->
                            <div class="border-base-content/20 rounded-box flex gap-4 border px-4 py-3">
                                <div class="avatar avatar-placeholder">
                                    <div class="text-accent bg-accent/20 rounded-field size-11.5">
                                        <span class="icon-[tabler--wallet] size-6.5"></span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-base-content/50 text-sm font-medium">Refunds</span>
                                    <span class="text-base-content text-lg font-semibold">$00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Goal Section -->
                    <div class="bg-base-200 item-center rounded-box flex justify-center max-md:w-full">
                        <div class="bg-base-200 rounded-box space-y-4 p-4">
                            <h3 class="text-base-content text-xl font-medium">Order Statuses</h3>
                            <!-- Radial Progress -->
                            <div id="order-status-chart" class="w-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                {{-- <div class="border-base-content/20 rounded-box flex gap-8 border p-6 max-md:flex-col">
                    <!-- Sales Plan -->
                    <div class="space-y-4">
                        <h3 class="card-title">Sales Plan</h3>
                        <div class="text-base-content text-7xl font-medium">54%</div>
                        <p class="text-base-content/50 text-lg">Percentage profit from total sales</p>
                    </div>

                    <!-- Cohort Analysis -->
                    <div class="space-y-6">
                        <h3 class="text-base-content text-xl font-medium">Cohart analysis indicators</h3>
                        <p class="text-base-content/50">Cohort analysis thoroughly analyzes the behaviour and engagement
                            patterns of a group of users who joined a product or service at the same time, tracking their
                            actions and retention over a certain period for deeper insights.</p>

                        <!-- Statistics Icons -->
                        <div class="text-base-content flex gap-6 max-sm:flex-col sm:items-center">
                            <div class="flex items-center gap-2">
                                <span class="icon-[tabler--chart-infographic] size-6"></span>
                                <span class="text-lg font-medium">Open Statistics</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="icon-[tabler--percentage] size-6"></span>
                                <span class="text-lg font-medium">Percentage Change</span>
                            </div>
                        </div>

                        <div class="progress rounded-field h-7 *:rounded-none">
                            <div class="progress-bar progress-primary w-full"></div>
                            <div class="progress-bar bg-primary/50 w-3/4"></div>
                            <div class="progress-bar bg-primary/30 w-2/4"></div>
                            <div class="progress-bar bg-primary/10 w-1/4"></div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Payment Status Table -->
    <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Order No.</th>
                        <th>Job Title</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($total_orders as $item)
                        <tr class="text-center">
                            <td>{{ dateFormat($item->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.edit', $item->id) }}"
                                    class="text-primary">#{{ $item->order_id }}</a>
                            </td>

                            <td>{{ Str::ucfirst($item->job_title) }}</td>
                            <td>${{ $item->price }} </td>
                            <td>{{ $item->image_quantity }} </td>
                            <td>
                                @if ($item->is_paid == 1)
                                    <span class="badge badge-soft badge-primary text-xs">@lang('Paid')</span>
                                @else
                                    <span class="badge badge-soft badge-error text-xs">@lang('Unpaid')</span>
                                @endif

                            </td>
                            <td>

                                @if ($item->status == 'In Review')
                                    <a href="" class=""><span
                                            class="badge badge-soft badge-success text-xs">In Review</span></a>
                                @elseif ($item->status == 'Pending')
                                    <a href="" class="badge badge-soft badge-primary text-xs">Pending</a>
                                @elseif ($item->status == 'Processing')
                                    <a href="" class="badge badge-soft badge-primary text-xs">Processing</a>
                                @elseif ($item->status == 'Received')
                                    <a href="" class="badge badge-soft badge-success text-xs">Received</a>
                                @elseif($item->status == 'Finalizing')
                                    <a href=""><span
                                            class="badge badge-soft badge-success text-xs">@lang('Finalized')</span></a>
                                @elseif($item->status == 'Completed')
                                    <a href="" class="badge badge-soft badge-success text-xs">@lang('Completed')</a>
                                @elseif($item->status == 'Invoiced')
                                    <a href="" class="badge badge-soft badge-info text-xs">@lang('Invoiced')</a>
                                @elseif ($item->status == 'Downloaded')
                                    <a href="" class="badge badge-soft badge-warning text-xs">Downloaded</a>
                                @elseif ($item->status == 'Canceled')
                                    <a href="" class="badge badge-soft badge-error text-xs">Canceled</a>
                                @endif


                            </td>

                            <td>
                                <a class="btn btn-circle btn-text btn-sm" href="{{ route('admin.orders.edit',$item->id) }}" aria-label="Action button"><span
                                        class="icon-[tabler--eye] size-5"></span></a>
                                <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                        class="icon-[tabler--trash] size-5"></span></button>
                                <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                        class="icon-[tabler--dots-vertical] size-5"></span></button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">
                                <p class="text-center text-error text-md font-semibold">@lang('No orders found')</p>
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
        (function() {
            const statusLabels = @json($statusLabels);
            const statusValues = @json($statusValues);
            const totalOrders = statusValues.reduce((a, b) => a + b, 0);

            // Order Status Chart
            buildChart('#order-status-chart', () => ({
                chart: {
                    height: 250,
                    width: '100%',
                    type: 'donut',
                    offsetX: 0,
                    parentHeightOffset: 0
                },
                labels: statusLabels,
                series: statusValues,
                colors: ['var(--color-primary)', 'var(--color-success)', 'var(--color-warning)', 'var(--color-error)', 'var(--color-info)'],
                stroke: {
                    width: 4,
                    colors: ['var(--color-base-200)']
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center', 
                },
                grid: {
                    show: false
                },
                states: {
                    hover: {
                        filter: { type: 'none' }
                    },
                    active: {
                        filter: { type: 'none' }
                    }
                },
                plotOptions: {
                    pie: {
                        expandOnClick: false,
                        donut: {
                            size: '75%',
                            background: 'transparent',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '1.5rem',
                                    fontFamily: 'Inter, ui-sans-serif',
                                    fontWeight: 700,
                                    color: 'var(--color-base-content)',
                                    offsetY: -5,
                                    formatter: function(val) {
                                        return parseInt(val);
                                    }
                                },
                                name: {
                                    offsetY: 20,
                                    fontFamily: 'Inter, ui-sans-serif'
                                },
                                total: {
                                    show: true,
                                    fontSize: '14px',
                                    color: 'var(--color-base-content)',
                                    fontWeight: 500,
                                    label: 'Total Orders',
                                    formatter: function(w) {
                                        return totalOrders;
                                    }
                                }
                            }
                        }
                    }
                }
            }));
        })();
    });
</script>
@endpush
