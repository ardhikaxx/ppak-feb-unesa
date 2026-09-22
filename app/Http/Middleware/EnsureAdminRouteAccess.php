<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defense-in-depth RBAC: setiap request CMS terotentikasi diperiksa
 * terhadap peta izin Admin::canAccessRoute() berdasarkan nama route.
 * Menolak dengan 403 bila tidak diizinkan —deny by default— sehingga
 * keamanan tidak bergantung pada disembunyikannya tombol di frontend.
 */
class EnsureAdminRouteAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (! $admin || ! $admin->canAccessRoute($request->route()?->getName())) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden.'], 403);
            }

            abort(403);
        }

        return $next($request);
    }
}
