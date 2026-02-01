<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Stats Data
        $today_orders = Order::whereDate('created_at', \Carbon\Carbon::today())->get();
        $progress = Order::where('status', 'Pending')->get();
        $total_orders = Order::latest()->limit(5)->get(); // Reduced limit to 5 for layout balance
        $total_orders_count = Order::count();
      
        // 3. Chart Data (Status)
        $targetStatuses = ['Pending', 'Approved', 'Shipped', 'Delivered', 'Cancelled', 'Returned'];
        
        $dbStatusCounts = Order::selectRaw('status, count(*) as count')
            ->whereIn('status', $targetStatuses)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statusLabels = $targetStatuses;
        $statusValues = [];

        foreach ($targetStatuses as $status) {
            $statusValues[] = $dbStatusCounts[$status] ?? 0;
        }

        // 4. Revenue Chart Data (Monthly Sales)
        $monthly_sales = Order::selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'Delivered')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
        
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = isset($monthly_sales[$i]) ? $monthly_sales[$i] : 0;
        }

        // 5. Top Products
        $top_products = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        // 6. New Customers
        $new_customers = User::where('role', 'customer')
            ->latest()
            ->limit(5)
            ->get();
            
        // 7. Earned Profit (Revenue from Delivered/Completed Orders)
        $earned_profit = Order::where('status', 'Delivered')->sum('price');

        return view('admin.dashboard', compact(
            'today_orders',
            'progress',
            'total_orders',
            'total_orders_count',
            'statusLabels',
            'statusValues',
            'revenueData',
            'top_products',
            'new_customers',
            'earned_profit'
        ));
    }
}
