<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Akses ditolak. Hanya Super Admin yang diizinkan.');
        }

        return $next($request);
    }
}