<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Notice;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Countries
        $countries = [
            ['name' => 'United States', 'code' => 'US', 'image' => null],
            ['name' => 'Canada', 'code' => 'CA', 'image' => null],
            ['name' => 'United Kingdom', 'code' => 'UK', 'image' => null],
            ['name' => 'Germany', 'code' => 'DE', 'image' => null],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }

        // Create Notices
        Notice::create(['title' => 'System Update Scheduled', 'publish_date' => Carbon::now()->subDays(1)]);
        Notice::create(['title' => 'New Policy for Returns', 'publish_date' => Carbon::now()->subDays(3)]);
        Notice::create(['title' => 'Holiday Schedule', 'publish_date' => Carbon::now()->subDays(5)]);

        // Create Orders
        // Today's Orders
        Order::create([
            'user_id' => $admin->id,
            'order_id' => 'ORD-'.rand(1000, 9999),
            'status' => 'Pending',
            'price' => 150.00,
            'job_title' => 'Photo Retouching',
            'image_quantity' => 10,
            'is_paid' => true,
            'created_at' => Carbon::today(),
        ]);

        Order::create([
            'user_id' => $admin->id,
            'order_id' => 'ORD-'.rand(1000, 9999),
            'status' => 'Processing',
            'price' => 200.50,
            'job_title' => 'Background Removal',
            'image_quantity' => 50,
            'is_paid' => false,
            'created_at' => Carbon::today(),
        ]);

        // Past Orders
        Order::create([
            'user_id' => $admin->id,
            'order_id' => 'ORD-'.rand(1000, 9999),
            'status' => 'Completed',
            'price' => 500.00,
            'job_title' => 'Bulk Editing',
            'image_quantity' => 200,
            'is_paid' => true,
            'created_at' => Carbon::yesterday(),
        ]);

        Order::create([
            'user_id' => $admin->id,
            'order_id' => 'ORD-'.rand(1000, 9999),
            'status' => 'Finalizing',
            'price' => 75.00,
            'job_title' => 'Color Correction',
            'image_quantity' => 5,
            'is_paid' => true,
            'created_at' => Carbon::now()->subDays(2),
        ]);
        
        Order::create([
            'user_id' => $admin->id,
            'order_id' => 'ORD-'.rand(1000, 9999),
            'status' => 'Canceled',
            'price' => 50.00,
            'job_title' => 'Test Order',
            'image_quantity' => 2,
            'is_paid' => false,
            'created_at' => Carbon::now()->subDays(5),
            'payment_method' => 'paypal'
        ]);
    }
}
