<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('details')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.list', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['details', 'orders', 'userDetail.country'])->findOrFail($id);
        
        // Calculate Stats for the view
        $totalOrders = $user->orders()->count();
        $stats = $user->orders()->selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');
        $paidOrdersCount = $user->orders()->where('payment_status', 'paid')->count();
        $unpaidOrdersCount = $user->orders()->where('payment_status', '!=', 'paid')->count();
        $totalSpent = $user->orders()->where('payment_status', 'paid')->sum('total');

        return view('admin.users.show', compact('user', 'totalOrders', 'stats', 'paidOrdersCount', 'unpaidOrdersCount', 'totalSpent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,user',
            'status' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
