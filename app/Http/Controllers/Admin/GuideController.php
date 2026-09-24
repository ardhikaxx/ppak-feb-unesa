<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class GuideController extends BaseAdminController
{
    /**
     * Halaman panduan penggunaan CMS per role (super_admin & operator).
     */
    public function index(): View
    {
        $admin = auth('admin')->user();

        return view('admin.guide.index', [
            'currentRole' => $admin?->role,
        ]);
    }
}
