<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('arin')->check()) {
            return redirect()->route('login');
        }

        if (Auth::guard('arin')->user()->user_role !== 'superadmin') {
            return redirect()->route('client.dashboard');
        }

        return $next($request);
    }
}