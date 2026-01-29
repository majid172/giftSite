<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display the shipping settings page.
     */
    public function index()
    {
        return view('admin.shipping.index');
    }

    /**
     * Update the shipping settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Shipping settings updated successfully.');
    }
}
