<?php

namespace App\Policies;

use App\Models\Admin;

/**
 * Modul konten yang boleh dikelola super_admin DAN operator
 * (berita, agenda, galeri, dokumen, FAQ, publikasi, kurikulum,
 * dosen, jadwal admisi, biaya pendidikan).
 */
class ContentPolicy extends BaseAdminPolicy
{
    protected function allows(Admin $user): bool
    {
        return $user->isSuperAdmin() || $user->isOperator();
    }
}
