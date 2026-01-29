<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Stats Data
        $today_orders = \App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->get();
        $progress = \App\Models\Order::where('status', 'Pending')->get();
        $total_orders = \App\Models\Order::latest()->limit(5)->get(); // Reduced limit to 5 for layout balance
        $total_orders_count = \App\Models\Order::count();
        
        // 2. Notices
        $notices = []; 

        // 3. Chart Data (Status)
        $statusCounts = \App\Models\Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statusLabels = array_keys($statusCounts);
        $statusValues = array_values($statusCounts);
        if(empty($statusLabels)) {
            $statusLabels = ['No Data'];
            $statusValues = [0];
        }

        // 4. Revenue Chart Data (Monthly Sales)
        $monthly_sales = \App\Models\Order::selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->whereYear('created_at', date('Y'))
            ->where('is_paid', 1)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
        
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = isset($monthly_sales[$i]) ? $monthly_sales[$i] : 0;
        }

        // 5. Top Products
        $top_products = \App\Models\Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        // 6. New Customers
        $new_customers = \App\Models\User::where('role', 'user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'today_orders',
            'progress',
            'total_orders',
            'total_orders_count',
            'notices',
            'statusLabels',
            'statusValues',
            'revenueData',
            'top_products',
            'new_customers'
        ));
    }
}
