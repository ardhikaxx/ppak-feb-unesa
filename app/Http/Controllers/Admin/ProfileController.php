<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends BaseAdminController
{
    public function edit(): View
    {
        return view('admin.profile.form', ['admin' => $this->admin()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = $this->admin();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,'.$admin?->id],
        ]);

        $admin?->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $admin = $this->admin();
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        if (! Hash::check($data['current_password'], $admin?->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $admin?->update(['password' => $data['password']]);

        return redirect()->route('admin.profile.edit')->with('success', 'Password berhasil diubah.');
    }
}
