<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and their role is 'user'
        if (Auth::check() && Auth::user()->role != 'user') {
            return $next($request); // Proceed to the requested route
        }

        // Redirect to home page or another route if role is not 'user'
        return redirect('admin/dashboard'); // Redirect to home page
    }
}
