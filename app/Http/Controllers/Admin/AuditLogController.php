<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class AuditLogController extends BaseAdminController implements HasMiddleware
{
    /**
     * Log audit: modul baca-saja, hanya super_admin.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,'.AuditLog::class, only: ['index']),
        ];
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'action' => ['nullable', 'string', 'max:50'],
        ]);

        $query = AuditLog::orderByDesc('id');

        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('auditable_type', 'like', "%{$q}%")->orWhere('ip_address', 'like', "%{$q}%"));
        }

        $logs = $query->paginate(20)->withQueryString();
        $actions = AuditLog::select('action')->distinct()->orderBy('action')->pluck('action');

        return view('admin.audit-logs.index', compact('logs', 'actions'));
    }
}
