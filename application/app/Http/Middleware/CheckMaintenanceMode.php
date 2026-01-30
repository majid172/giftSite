<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled
        if (get_setting('maintenance_mode') === '1') {
            // Allow if user is admin or if the route is the login route/admin routes
            // We need to allow login page so admins can login
            // Assuming admin routes start with 'admin' or user is already logged in as admin
            
            if ($request->is('admin/*') || $request->is('login') || $request->is('logout')) {
                return $next($request);
            }
            
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Return 503 Maintenance Mode
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
