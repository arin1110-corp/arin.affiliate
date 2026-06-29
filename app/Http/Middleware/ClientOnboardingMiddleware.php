<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientOnboardingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('arin')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->user_role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        if (
            !$user->user_email_verified_at &&
            !$request->routeIs('client.verify.*')
        ) {
            return redirect()
                ->route('client.verify.notice');
        }

        if (
            $user->user_email_verified_at &&
            $user->user_payment_status !== 'paid' &&
            !$request->routeIs('client.payment.*')
        ) {
            return redirect()
                ->route('client.payment.checkout');
        }

        if (
            $user->user_payment_status === 'paid' &&
            !$user->user_is_setup_done &&
            !$request->routeIs('client.setup.*')
        ) {
            return redirect()
                ->route('client.setup.index');
        }

        return $next($request);
    }
}