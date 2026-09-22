<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Tolak akun nonaktif sebelum cek password (tidak membocorkan info).
        $candidate = Admin::where('email', $credentials['email'])->first();
        if ($candidate && ! $candidate->is_active) {
            return back()->withErrors(['email' => 'Akun ini dinonaktifkan. Hubungi administrator utama.'])->onlyInput('email');
        }

        if (! Auth::guard('admin')->attempt($credentials, $remember)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        $admin = Auth::guard('admin')->user();
        $admin->forceFill(['last_login_at' => now()])->save();

        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Selamat datang, '.$admin->name.'.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah logout dengan aman.');
    }

    public function showForgot(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.forgot');
    }

    public function verifyEmail(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $admin = Admin::where('email', $data['email'])->first();

        if (! $admin || ! $admin->is_active) {
            return back()
                ->with('error', 'Email tidak ditemukan atau akun nonaktif.')
                ->onlyInput('email');
        }

        $request->session()->put('admin_pw_reset_email', $admin->email);

        return redirect()->route('admin.password.reset')
            ->with('success', 'Email terverifikasi. Silakan buat password baru.');
    }

    public function showReset(Request $request): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        $email = $request->session()->get('admin_pw_reset_email');

        if (! $email) {
            return redirect()->route('admin.password.request')
                ->with('error', 'Silakan verifikasi email terlebih dahulu.');
        }

        return view('admin.auth.reset', ['email' => $email]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $email = $request->session()->get('admin_pw_reset_email');

        if (! $email) {
            return redirect()->route('admin.password.request')
                ->with('error', 'Silakan verifikasi email terlebih dahulu.');
        }

        $data = $request->validate([
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        $admin = Admin::where('email', $email)->first();

        if (! $admin || ! $admin->is_active) {
            $request->session()->forget('admin_pw_reset_email');

            return redirect()->route('admin.password.request')
                ->with('error', 'Email tidak ditemukan atau akun nonaktif.');
        }

        $admin->update(['password' => $data['password']]);

        $request->session()->forget('admin_pw_reset_email');

        return redirect()->route('admin.login')
            ->with('success', 'Password sudah berhasil diubah. Silakan login dengan password baru.')
            ->with('password_reset_success', true);
    }
}
