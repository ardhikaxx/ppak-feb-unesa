<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProgramProfileRequest;
use App\Models\ProgramProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class ProgramProfileController extends BaseAdminController implements HasMiddleware
{
    /**
     * Profil program adalah modul singleton (tanpa route binding):
     * policy dipanggil dengan class-string, ability update.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:update,'.ProgramProfile::class, only: ['edit', 'update']),
        ];
    }

    public function edit(): View
    {
        $profile = ProgramProfile::firstOrNew(['program_code' => '62902']);

        return view('admin.program-profile.form', compact('profile'));
    }

    public function update(ProgramProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $socials = array_filter([
            'instagram' => $data['social_instagram'] ?? null,
            'instagram_feb' => $data['social_instagram_feb'] ?? null,
            'youtube' => $data['social_youtube'] ?? null,
            'tiktok' => $data['social_tiktok'] ?? null,
            'facebook' => $data['social_facebook'] ?? null,
            'linkedin' => $data['social_linkedin'] ?? null,
        ]);

        unset(
            $data['social_instagram'], $data['social_instagram_feb'], $data['social_youtube'],
            $data['social_tiktok'], $data['social_facebook'], $data['social_linkedin']
        );

        $profile = ProgramProfile::firstOrNew(['program_code' => $data['program_code'] ?? '62902']);
        $old = $profile->exists ? $profile->toArray() : [];

        $profile->fill(array_merge($data, ['social_links' => $socials ?: null]));
        $profile->save();

        $this->audit('updated', $profile, $profile->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.program-profile.edit')->with('success', 'Profil program berhasil diperbarui dan langsung tampil di website.');
    }
}
