<?php

use App\Models\Admin;
use App\Models\SiteSetting;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

test('artisan seo:audit command executes successfully with 100% pass', function () {
    $this->artisan('seo:audit')
        ->expectsOutputToContain('PPAk FEB UNESA - INTERNAL TECHNICAL SEO AUDIT RUNNER')
        ->expectsOutputToContain('Total Pages Audited: 26')
        ->expectsOutputToContain('Issues: 0')
        ->assertExitCode(0);
});

test('public pages contain required SEO meta tags and single H1', function () {
    $routes = [
        route('home'),
        route('profil.sejarah'),
        route('akademik.kurikulum'),
        route('admisi.biaya'),
        route('admisi.jalur-syarat'),
        route('kontak.lokasi'),
    ];

    foreach ($routes as $url) {
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertSee('<meta name="description"', false);
        $response->assertSee('<meta property="og:image"', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('lang="id"', false);

        // Single H1 assertion
        $content = $response->getContent();
        preg_match_all('/<h1[^>]*>/is', $content, $h1Matches);
        expect(count($h1Matches[0]))->toBe(1);
    }
});

test('admin can access seo health dashboard and flush sitemap cache', function () {
    $admin = Admin::first();

    $response = $this->actingAs($admin, 'admin')->get(route('admin.seo-health.index'));
    $response->assertStatus(200);
    $response->assertSee('Kesehatan & Audit SEO');
    $response->assertSee('Rute Publik Terindeks');
    $response->assertSee('EducationalOrganization');

    $flushResponse = $this->actingAs($admin, 'admin')->post(route('admin.seo-health.flush-cache'));
    $flushResponse->assertRedirect(route('admin.seo-health.index'));
    $flushResponse->assertSessionHas('success');
});

test('institutional og_image cannot be updated via site settings admin', function () {
    $admin = Admin::first();

    $originalOg = SiteSetting::where('key', 'og_image')->value('value');

    // Attempt to update og_image
    $response = $this->actingAs($admin, 'admin')->put(route('admin.site-settings.update'), [
        'settings' => [
            'site_title' => 'Pendidikan Profesi Akuntan FEB UNESA Test Title',
            'og_image' => '/images/malicious-or-changed.jpg',
        ],
    ]);

    $response->assertRedirect(route('admin.site-settings.index'));

    // Verify og_image is still original and not changed
    $currentOg = SiteSetting::where('key', 'og_image')->value('value');
    expect($currentOg)->toBe($originalOg);
});
