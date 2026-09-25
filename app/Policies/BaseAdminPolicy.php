<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

/**
 * Dasar otorisasi seluruh modul CMS.
 *
 * Setiap ability didelegasikan ke allows() sehingga kebijakan per-role
 * hanya ditulis sekali, lalu dipetakan ke banyak model lewat
 * Gate::policy() di AppServiceProvider. Model yang TIDAK terdaftar
 * pada Gate::policy() otomatis ditolak (deny by default).
 *
 * Parameter model bersifat opsional: Gate menghapus argumen string
 * (class-string) sebelum memanggil policy, sehingga ability tertentu
 * boleh dipanggil tanpa instance — mis. modul singleton yang tidak
 * punya route binding. Kebijakan sendiri tidak pernah membaca isi
 * model, jadi kehilangan instance tidak mengubah hasil.
 */
abstract class BaseAdminPolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->allows($user);
    }

    public function view(Admin $user, ?Model $model = null): bool
    {
        return $this->allows($user);
    }

    public function create(Admin $user): bool
    {
        return $this->allows($user);
    }

    public function update(Admin $user, ?Model $model = null): bool
    {
        return $this->allows($user);
    }

    public function delete(Admin $user, ?Model $model = null): bool
    {
        return $this->allows($user);
    }

    public function restore(Admin $user, ?Model $model = null): bool
    {
        return $this->allows($user);
    }

    public function forceDelete(Admin $user, ?Model $model = null): bool
    {
        return $this->allows($user);
    }

    abstract protected function allows(Admin $user): bool;
}
