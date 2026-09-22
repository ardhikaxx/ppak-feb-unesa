<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';

    public const ROLE_OPERATOR = 'operator';

    public const ROLES = [self::ROLE_SUPER_ADMIN, self::ROLE_OPERATOR];

    /**
     * Route CMS yang boleh diakses operator (awalan nama route).
     * Super admin boleh mengakses seluruh route. Selain daftar ini
     * (kelola admin, pengaturan, SEO, audit log, helpdesk, media, dsb.)
     * khusus super_admin dan ditolak di backend (403), bukan sekadar
     * disembunyikan di sidebar.
     */
    public const OPERATOR_ROUTE_PREFIXES = [
        'admin.dashboard',
        'admin.logout',
        'admin.profile.',
        'admin.news.',
        'admin.agendas.',
        'admin.galleries.',
        'admin.documents.',
        'admin.faqs.',
        'admin.publications.',
        'admin.curricula.',
        'admin.lecturers.',
        'admin.admission-schedules.',
        'admin.tuition-fees.',
    ];

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        // Jaring pengaman: jamin selalu ada >=1 super_admin untuk
        // pembuatan programatik (tinker, test). Berjalan hanya saat
        // model events aktif (tidak saat db:seed via WithoutModelEvents;
        // kasus itu dijamin oleh default kolom + backfill migration).
        static::creating(function (Admin $admin) {
            if (! in_array($admin->role, self::ROLES, true)) {
                $admin->role = self::ROLE_OPERATOR;
            }

            if (! static::where('role', self::ROLE_SUPER_ADMIN)->exists()) {
                $admin->role = self::ROLE_SUPER_ADMIN;
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSuperAdmins($query)
    {
        return $query->where('role', self::ROLE_SUPER_ADMIN);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isOperator(): bool
    {
        return $this->role === self::ROLE_OPERATOR;
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    /**
     * Otorisasi berbasis route untuk enforcement server-side (OWASP:
     * authorization ditegakkan di backend). Dipakai middleware
     * admin.access; deny-by-default untuk route tak dikenal.
     */
    public function canAccessRoute(?string $routeName): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        // CMS hanya mengenal 2 role: selain operator ditolak total.
        if (! $this->isOperator() || ! $routeName) {
            return false;
        }

        foreach (self::OPERATOR_ROUTE_PREFIXES as $prefix) {
            if ($routeName === $prefix || str_starts_with($routeName, $prefix)) {
                return true;
            }
        }

        return false;
    }
}
