<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('admin')) {
            return redirect('admin-login');
        }

        return $next($request);
    }

    //  public function handle(Request $request, Closure $next): Response
    // {
    //     if (!auth()->check()) {
    //       return redirect('admin-login')->with('error', 'Please login to access this page.');
    //     }
    //         return $next($request);
    // }
}
