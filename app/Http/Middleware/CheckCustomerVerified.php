<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            return $next($request);
        }

        $user = Auth::guard('customer')->user();

        if ($user->status !== 'Verified') {
            // Allowed URLs for non-verified customers

            $allowedRoutes = [
                'ads.dashboard',
                'ads.profile',
                'ads.updateProfile',
                'ads.verifyOtp',
                'ads.resendOtp',
                'ads.logout',
            ];

            if ($request->route() && !in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('ads.dashboard')->with('error', 'Please verify your account to continue.');
            }
        }

        return $next($request);
    }
}
