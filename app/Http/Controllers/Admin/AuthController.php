<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
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

    /**
     * Kirim tautan reset via token email (bukan verifikasi session).
     * Respons SELALU sama untuk email terdaftar maupun tidak
     * (mencegah user enumeration).
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $generic = 'Jika email terdaftar pada akun admin aktif, tautan untuk mengatur ulang password telah dikirim. Periksa kotak masuk atau folder spam Anda.';

        // Hanya kirim token bila akun ada & aktif; respons identik di kedua kasus.
        if (Admin::where('email', $data['email'])->where('is_active', true)->exists()) {
            Password::broker('admins')->sendResetLink(['email' => $data['email']]);
        }

        return redirect()->route('admin.password.request')->with('info', $generic);
    }

    public function showReset(Request $request): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        $token = (string) $request->query('token', '');
        $email = (string) $request->query('email', '');

        if ($token === '' || $email === '' || ! $this->validResetToken($email, $token)) {
            return redirect()->route('admin.password.request')
                ->with('error', 'Tautan reset tidak valid atau sudah kedaluwarsa. Silakan minta tautan baru.');
        }

        return view('admin.auth.reset', ['email' => $email, 'token' => $token]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', PasswordRule::min(8)->mixedCase()->numbers(), 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        $invalid = 'Tautan reset tidak valid atau sudah kedaluwarsa. Silakan minta tautan baru.';

        if (! $this->validResetToken($data['email'], $data['token'])) {
            return redirect()->route('admin.password.request')->with('error', $invalid);
        }

        $response = Password::broker('admins')->reset(
            [
                'token' => $data['token'],
                'email' => $data['email'],
                'password' => $data['password'],
                'password_confirmation' => $request->input('password_confirmation'),
            ],
            function (Admin $admin, string $password): void {
                $admin->forceFill(['password' => $password])->save();
            }
        );

        if ($response !== Password::PASSWORD_RESET) {
            return redirect()->route('admin.password.request')->with('error', $invalid);
        }

        return redirect()->route('admin.login')
            ->with('success', 'Password sudah berhasil diubah. Silakan login dengan password baru.')
            ->with('password_reset_success', true);
    }

    /**
     * Token valid hanya untuk akun aktif + token hash cocok (broker admins).
     */
    private function validResetToken(string $email, string $token): bool
    {
        $admin = Admin::where('email', $email)->where('is_active', true)->first();

        return $admin !== null && Password::broker('admins')->tokenExists($admin, $token);
    }
}
