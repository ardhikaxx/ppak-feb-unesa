<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class SiteSettingController extends BaseAdminController implements HasMiddleware
{
    /**
     * Pengaturan website: modul singleton per-key, tanpa route binding,
     * sehingga policy dipanggil dengan class-string.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,'.SiteSetting::class, only: ['index']),
            new Middleware('can:update,'.SiteSetting::class, only: ['update']),
        ];
    }

    public function index(): View
    {
        // og_image disembunyikan: OG institusional statis, bukan kelolaan admin.
        $settings = SiteSetting::where('key', '!=', 'og_image')
            ->orderBy('group')->orderBy('sort_order')->get()->groupBy('group');

        $groups = [
            'general' => 'Umum (nama website, footer)',
            'contact' => 'Kontak & Layanan',
            'social' => 'Media Sosial',
            'seo' => 'SEO & Metadata',
            'admission' => 'Tautan Admisi',
        ];

        return view('admin.site-settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::where('key', '!=', 'og_image')->get();

        $rules = [];
        foreach ($settings as $setting) {
            $rules["settings.{$setting->key}"] = match ($setting->type) {
                'email' => ['nullable', 'email', 'max:255'],
                'url' => ['nullable', 'url', 'max:500'],
                default => ['nullable', 'string', 'max:2000'],
            };
        }

        $validated = $request->validate($rules, [
            'settings.*.url' => 'Format URL tidak valid (sertakan https://).',
            'settings.*.email' => 'Format email tidak valid.',
        ]);

        foreach ($settings as $setting) {
            $value = $validated['settings'][$setting->key] ?? null;
            if ($value !== $setting->value) {
                $setting->update(['value' => $value]);
            }
        }

        $this->audit('updated', $settings->first(), ['site-settings' => 'bulk update']);
        $this->flushContentCache();

        return redirect()->route('admin.site-settings.index')->with('success', 'Pengaturan website berhasil disimpan dan langsung berlaku.');
    }
}
