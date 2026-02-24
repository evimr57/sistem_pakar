<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah user punya akses admin (admin ATAU super_admin)
        if (!auth()->user()->hasAdminAccess()) {
            abort(403, 'Akses ditolak. Hanya Admin yang diizinkan.');
        }

        return $next($request);
    }
}