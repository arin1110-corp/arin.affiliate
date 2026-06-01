<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArinAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('arin')->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}