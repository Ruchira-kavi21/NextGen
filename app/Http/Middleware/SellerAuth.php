<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SellerAuth
{
    public function handle(Request $request, Closure $next)
    {
        $isAuthenticated = Auth::guard('seller')->check();
        \Log::info('SellerAuth middleware check', [
            'is_authenticated' => $isAuthenticated,
            'user' => $isAuthenticated ? Auth::guard('seller')->user() : null,
        ]);

        if (!$isAuthenticated) {
            return redirect('/login')->with('error', 'Please login as a seller to access this page.');
        }

        return $next($request);
    }
}