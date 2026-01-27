<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $today_orders = \App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->get();
        $total_orders = \App\Models\Order::all();
        $progress = \App\Models\Order::whereNotIn('status', ['Completed', 'Canceled'])->get();
        $total_price = \App\Models\Order::sum('price');
        $notices = [];
        
        // Mocking user countries distribution for now as we don't have country_id on users yet
        // In real app: $countries = User::select('country_id', DB::raw('count(*) as total'))->groupBy('country_id')->get();
        $countries = [];


        $sales_trend = $total_price ?? 0; // Simplified for now
        $total_profit = $total_price * 0.20; // 20% margin
        $refunds = 0; // Simplified

        // Order Status Chart Data
        $statuses = ['Pending', 'Processing', 'Completed', 'Canceled', 'Finalizing'];
        $statusLabels = $statuses;
        $statusValues = [];
        foreach ($statuses as $status) {
            $statusValues[] = \App\Models\Order::where('status', $status)->count();
        }

        return view('admin.dashboard', compact(
            'today_orders',
            'total_orders',
            'progress',
            'total_price',
            'notices',
            'countries',
            'sales_trend',
            'total_profit',
            'refunds',
            'statusLabels',
            'statusValues'
        ));
    }

}
