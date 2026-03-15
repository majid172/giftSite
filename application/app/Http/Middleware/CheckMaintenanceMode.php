<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{

    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled in settings
        $isMaintenance = get_setting('maintenance_mode') == '1';
        
        // Manual bypass via query string (e.g. ?preview=yoursecretkey)
        // You can change 'preview_mode' to something more secure if needed
        if ($request->has('preview_mode')) {
            session(['maintenance_bypass' => true]);
        }

        if ($isMaintenance) {
            // 1. Allow Admin Routes & Auth Routes
            if ($request->is('admin*') || $request->is('login') || $request->is('logout')) {
                return $next($request);
            }
            
            // 2. Allow if user is logged in as admin
            if (auth()->check() && auth()->user()->role === 'admin') {
                return $next($request);
            }

            // 3. Allow if bypass session is active
            if (session('maintenance_bypass')) {
                return $next($request);
            }

            // Otherwise, show the 503 Maintenance page
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
