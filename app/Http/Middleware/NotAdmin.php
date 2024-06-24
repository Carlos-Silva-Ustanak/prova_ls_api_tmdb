<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return $next($request);
        }

        // Redirect admin users or show a 403 forbidden page
        return redirect('admin/dashboard')->with('error', 'You are not authorized to access this page.');
    }
}
