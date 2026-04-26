<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  <-- Parameter tambahan untuk mengecek role
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user di database sesuai dengan yang diminta
        if (!auth()->check() || auth()->user()->role !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden: Anda tidak punya akses (Hanya ' . $role . ')'
            ], 403); // Status 403 Forbidden sesuai standar response API
        }

        // Jika lolos pengecekan, lanjut ke proses berikutnya (Controller)
        return $next($request);
    }
}