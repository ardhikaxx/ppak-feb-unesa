<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminAccountRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAccountController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate(['q' => ['nullable', 'string', 'max:100']]);

        $query = Admin::orderBy('name');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%"));
        }

        $admins = $query->paginate(12)->withQueryString();

        return view('admin.admins.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admin.admins.form', ['account' => new Admin]);
    }

    public function store(AdminAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        $account = Admin::create($data);

        $this->audit('created', $account, ['id' => $account->id, 'name' => $account->name, 'email' => $account->email]);

        return redirect()->route('admin.admins.index')->with('success', 'Akun admin berhasil dibuat.');
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.form', ['account' => $admin]);
    }

    public function update(AdminAccountRequest $request, Admin $admin): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Cegah admin menonaktifkan dirinya sendiri.
        if ($admin->id === $this->admin()->id && ! $data['is_active']) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.')->withInput();
        }

        $admin->update($data);

        $this->audit('updated', $admin, ['id' => $admin->id, 'name' => $admin->name, 'email' => $admin->email, 'is_active' => $admin->is_active]);

        return redirect()->route('admin.admins.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        if ($admin->id === $this->admin()->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        if (Admin::where('is_active', true)->count() <= 1 && $admin->is_active) {
            return back()->with('error', 'Tidak dapat menghapus satu-satunya admin aktif.');
        }

        $admin->delete();
        $this->audit('deleted', $admin, ['email' => $admin->email]);

        return redirect()->route('admin.admins.index')->with('success', 'Akun admin dihapus.');
    }
}
