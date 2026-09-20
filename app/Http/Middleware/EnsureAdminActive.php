<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Guard khusus CMS: hanya admin aktif yang boleh lewat.
 * Pengunjung biasa / belum login diarahkan ke halaman login admin.
 */
class EnsureAdminActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (! $admin || ! $admin->is_active) {
            Auth::guard('admin')->logout();

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()
                ->route('admin.login')
                ->with('error', 'Sesi Anda telah berakhir atau akun nonaktif. Silakan login kembali.');
        }

        return $next($request);
    }
}
