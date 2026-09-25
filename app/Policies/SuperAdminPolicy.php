<?php

namespace App\Policies;

use App\Models\Admin;

/**
 * Modul sensitif yang hanya boleh dikelola super_admin
 * (profil program, CPL, kalender, riset/PKM/mitra, testimoni,
 * alumni, kategori, pengaturan website, helpdesk, kelola admin).
 */
class SuperAdminPolicy extends BaseAdminPolicy
{
    protected function allows(Admin $user): bool
    {
        return $user->isSuperAdmin();
    }
}
