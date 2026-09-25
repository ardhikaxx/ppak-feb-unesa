<?php

namespace App\Http\Controllers\Admin;

use App\Models\HelpdeskInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HelpdeskController extends BaseAdminController implements HasMiddleware
{
    /**
     * Helpdesk: khusus super_admin (route admin.role:super_admin).
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,'.HelpdeskInquiry::class, only: ['index']),
            new Middleware('can:view,inquiry', only: ['show']),
            new Middleware('can:update,inquiry', only: ['update']),
        ];
    }

    public function index(Request $request): View
    {
        $request->validate([
            'status' => ['nullable', 'in:open,in_progress,closed'],
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $query = HelpdeskInquiry::orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('name', 'like', "%{$q}%")->orWhere('subject', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%"));
        }

        $items = $query->paginate(15)->withQueryString();

        return view('admin.helpdesk.index', compact('items'));
    }

    public function show(HelpdeskInquiry $inquiry): View
    {
        return view('admin.helpdesk.show', compact('inquiry'));
    }

    public function update(Request $request, HelpdeskInquiry $inquiry): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['open', 'in_progress', 'closed'])],
        ]);

        $old = $inquiry->toArray();
        $inquiry->update($data);

        $this->audit('updated', $inquiry, $inquiry->fresh()->toArray(), $old);

        return redirect()->route('admin.helpdesk.show', $inquiry)->with('success', 'Status tiket diperbarui.');
    }
}
