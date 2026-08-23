<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Allow access to admin panel routes and Livewire core assets
        if ($request->is('admin*') || $request->is('livewire*')) {
            return $next($request);
        }

        // 2. Allow access if the user is authenticated (admin)
        if (auth()->check()) {
            return $next($request);
        }

        // 3. Check if maintenance mode is enabled
        try {
            $isMaintenance = Setting::get('maintenance_mode', 'false') === 'true';
        } catch (\Exception $e) {
            // Fallback in case table doesn't exist yet during installation/migrations
            $isMaintenance = false;
        }

        if ($isMaintenance) {
            return response()->view('errors.under-construction', [], 503);
        }

        return $next($request);
    }
}
