<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notifikasi reset password khusus admin: tautan mengarah ke
 * route admin.password.reset (bukan password.reset publik).
 */
class AdminResetPasswordNotification extends ResetPasswordNotification
{
    protected function resetUrl($notifiable): string
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }

    protected function buildMailMessage($url): MailMessage
    {
        $expire = (int) config('auth.passwords.admins.expire', 60);

        return (new MailMessage)
            ->subject('Atur Ulang Password Admin PPAk FEB UNESA')
            ->line('Kami menerima permintaan pengaturan ulang password untuk akun admin Anda.')
            ->action('Atur Ulang Password', $url)
            ->line("Tautan ini berlaku selama {$expire} menit dan hanya dapat digunakan satu kali.")
            ->line('Jika Anda tidak meminta pengaturan ulang password, abaikan email ini.');
    }
}
