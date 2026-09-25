<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Visibilitas file upload di route GET /uploads/{path}.
 *
 * File fisik tersimpan di storage/uploads dan direferensikan oleh record
 * CMS. Sebelumnya semua file yang ada di disk dapat diakses publik,
 * termasuk file milik berita/dokumen/galeri berstatus draft atau yang
 * sudah soft delete. Kelas ini menghitung daftar path milik record
 * NON-publik lalu menyembunyikannya (404) dari tamu.
 *
 * Kebijakan:
 * - File yang TIDAK dikenal database (aset statis, file lama) tetap
 *   diizinkan agar tidak memutus halaman yang sudah tayang.
 * - Admin CMS selalu boleh membuka file (preview draft di dashboard).
 * - Hasil di-cache per TTL; di-flush bersama ContentCache::flush().
 */
final class UploadVisibility
{
    /**
     * Cache key daftar path milik record non-publik.
     */
    public const CACHE_KEY = 'ppak:uploads:blocked';

    /**
     * Tabel, kolom berkas, dan status yang dianggap tampil di publik.
     *
     * @var list<array{table: string, columns: list<string>, status: string}>
     */
    private const REGISTRY = [
        ['table' => 'news', 'columns' => ['image', 'image_thumb', 'og_image'], 'status' => 'published'],
        ['table' => 'documents', 'columns' => ['path'], 'status' => 'published'],
        ['table' => 'galleries', 'columns' => ['image', 'image_thumb', 'image_medium'], 'status' => 'published'],
        ['table' => 'lecturers', 'columns' => ['image', 'image_thumb'], 'status' => 'active'],
        ['table' => 'testimonials', 'columns' => ['avatar'], 'status' => 'published'],
        ['table' => 'partnerships', 'columns' => ['logo'], 'status' => 'active'],
    ];

    /**
     * Apakah path relatif (mis. "news/slug-123.webp") boleh diserve?
     */
    public static function isPublic(string $path): bool
    {
        // Admin CMS boleh membuka file draft miliknya (preview).
        if (auth('admin')->check()) {
            return true;
        }

        $path = self::normalize($path);

        if ($path === '') {
            return false;
        }

        $blocked = Cache::remember(
            self::CACHE_KEY,
            (int) config('ppak.cache.ttl.uploads', 600),
            fn () => self::blockedPaths()
        );

        return ! in_array($path, $blocked, true);
    }

    /**
     * Buang cache daftar file terblokir (dipanggil dari ContentCache::flush()).
     */
    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Normalisasi: buang prefix /uploads/ dan karakter berlebih
     * sehingga cocok dengan path relatif route.
     */
    private static function normalize(string $path): string
    {
        $path = str_replace('\\', '/', $path);
        $path = ltrim($path, '/');

        if (str_starts_with($path, 'uploads/')) {
            $path = substr($path, 8);
        }

        return $path;
    }

    /**
     * Kumpulkan path file milik record non-publik.
     *
     * @return list<string>
     */
    private static function blockedPaths(): array
    {
        $blocked = [];

        foreach (self::REGISTRY as $source) {
            $rows = DB::table($source['table'])
                ->select(array_merge($source['columns'], ['status']))
                ->get();

            foreach ($rows as $row) {
                // Record tampil di publik -> filenya tetap terbuka.
                if ($row->status === $source['status']) {
                    continue;
                }

                foreach ($source['columns'] as $column) {
                    $value = trim((string) ($row->{$column} ?? ''));

                    if ($value === '') {
                        continue;
                    }

                    // Nilai disimpan sebagai /uploads/xxx di DB.
                    $blocked[] = self::normalize($value);
                }
            }
        }

        return array_values(array_unique($blocked));
    }
}
