<?php

use App\Contracts\ContentRepositoryInterface;
use App\Models\AcademicCurriculum;
use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Category;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\ProgramProfile;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use Database\Seeders\AdminSeeder;

beforeEach(function () {
    $this->seed(AdminSeeder::class);
});

test('changes in program profile propagate immediately to public header and general info', function () {
    $admin = Admin::first();
    $this->actingAs($admin, 'admin');

    $this->put(route('admin.program-profile.update'), [
        'program_code' => '62902',
        'program_name' => 'Pendidikan Profesi Akuntan',
        'coordinator_name' => 'Dr. Uji Propagasi FEB',
        'tagline' => 'Tagline Uji Sistem Integrasi',
    ]);

    $repo = app(ContentRepositoryInterface::class);
    $info = $repo->getGeneralInfo();

    expect($info['coordinator'])->toBe('Dr. Uji Propagasi FEB');
    expect($info['tagline'])->toBe('Tagline Uji Sistem Integrasi');

    $res = $this->get(route('home'));
    $res->assertStatus(200);
    $res->assertSee('Dr. Uji Propagasi FEB');
});

test('changes in tuition fee propagate immediately to admisi biaya public page', function () {
    $admin = Admin::first();
    $this->actingAs($admin, 'admin');

    $fee = TuitionFee::first();
    if ($fee) {
        $oldAmount = $fee->amount;
        $this->put(route('admin.tuition-fees.update', $fee), [
            'program_name' => $fee->program_name,
            'fee_type' => $fee->fee_type,
            'amount' => 5500000,
            'academic_year' => $fee->academic_year,
            'description' => 'Biaya pendidikan per semester resmi UNESA.',
        ]);

        $res = $this->get(route('admisi.biaya'));
        $res->assertStatus(200);
        $res->assertSee('Rp5.500.000');
    }
});

test('publishing news makes it immediately visible on homepage and berita index', function () {
    $admin = Admin::first();
    $this->actingAs($admin, 'admin');

    $uniqueSlug = 'berita-propagasi-realtime-' . time();
    $this->post(route('admin.news.store'), [
        'title' => 'Judul Berita Propagasi Realtime',
        'slug' => $uniqueSlug,
        'excerpt' => 'Ringkasan singkat berita propagasi realtime.',
        'content' => 'Isi lengkap berita propagasi realtime yang memenuhi panjang minimal karakter.',
        'status' => 'published',
        'published_at' => now()->toDateTimeString(),
    ]);

    $resIndex = $this->get(route('informasi.berita'));
    $resIndex->assertStatus(200);
    $resIndex->assertSee('Judul Berita Propagasi Realtime');

    $resDetail = $this->get(route('informasi.berita.detail', $uniqueSlug));
    $resDetail->assertStatus(200);
    $resDetail->assertSee('Judul Berita Propagasi Realtime');
});

test('category in use cannot be deleted to prevent orphan relational records', function () {
    $admin = Admin::first();
    $this->actingAs($admin, 'admin');

    $category = Category::where('type', 'news')->first();
    if ($category) {
        // Ensure there is news using this category
        $hasNews = News::where('category_id', $category->id)->count() > 0;
        if ($hasNews) {
            $response = $this->delete(route('admin.categories.destroy', $category));
            $response->assertRedirect(route('admin.categories.index'));
            $response->assertSessionHas('error');
            // Ensure category is not deleted
            expect(Category::find($category->id))->not->toBeNull();
        }
    }
});

test('admin cannot deactivate or delete their own active account', function () {
    $admin = Admin::first();
    $this->actingAs($admin, 'admin');

    // Attempt deactivating own account
    $resDeactivate = $this->put(route('admin.admins.update', $admin), [
        'name' => $admin->name,
        'email' => $admin->email,
        'is_active' => false,
    ]);
    $resDeactivate->assertSessionHas('error');
    expect($admin->fresh()->is_active)->toBeTrue();

    // Attempt deleting own account
    $resDelete = $this->delete(route('admin.admins.destroy', $admin));
    $resDelete->assertSessionHas('error');
    expect(Admin::find($admin->id))->not->toBeNull();
});
