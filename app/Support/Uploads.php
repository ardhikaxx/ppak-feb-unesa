<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Upload manager ala proyek sepeda-listrik.
 *
 * - File fisik di storage/uploads/... (storage_path('uploads'))
 * - TANPA php artisan storage:link.
 * - Diserve lewat route GET /uploads/{path} (lihat routes/web.php).
 * - Mendukung tambah (store), edit/ganti (replace), hapus (delete)
 *   untuk gambar APAPUN dan file APAPUN.
 *
 * Nilai yang disimpan di DB adalah path publik, contoh:
 *   /uploads/news/slug-1700000000-ab12cd.webp
 *   /uploads/documents/pedoman-1700000000.pdf
 */
class Uploads
{
    /**
     * Root fisik upload.
     */
    public static function basePath(): string
    {
        return storage_path('uploads');
    }

    /**
     * Normalisasi direktori: hanya [a-z0-9-_/], cegah traversal.
     */
    public static function sanitizeDirectory(string $directory): string
    {
        $directory = trim(str_replace('\\', '/', $directory), '/');
        $directory = preg_replace('#[^a-zA-Z0-9\-_/]#', '', $directory);
        $directory = preg_replace('#/+#', '/', $directory);

        if ($directory === '' || str_contains($directory, '..')) {
            return 'general';
        }

        return $directory;
    }

    public static function ensureDirectory(string $directory): string
    {
        $directory = self::sanitizeDirectory($directory);
        $absolute = self::basePath().'/'.$directory;

        if (! File::exists($absolute)) {
            File::makeDirectory($absolute, 0755, true);
        }

        return $directory;
    }

    /**
     * Ubah stored path (/uploads/..., uploads/..., /storage/...) jadi path absolut.
     * Mendukung legacy /storage/... (storage/app/public) agar file lama tetap terbaca.
     */
    public static function absolutePath(?string $storedPath): ?string
    {
        if (! $storedPath) {
            return null;
        }

        $normalized = trim(str_replace('\\', '/', $storedPath));

        // URL absolut -> ambil path-nya saja.
        if (str_starts_with($normalized, 'http://') || str_starts_with($normalized, 'https://')) {
            $normalized = (string) parse_url($normalized, PHP_URL_PATH);
        }

        $normalized = ltrim($normalized, '/');

        if (str_starts_with($normalized, 'uploads/')) {
            return self::basePath().'/'.substr($normalized, strlen('uploads/'));
        }

        // Backward compat: file lama di storage/app/public via symlink /storage/...
        if (str_starts_with($normalized, 'storage/')) {
            return storage_path('app/public/'.substr($normalized, strlen('storage/')));
        }

        // Sudah absolut?
        if (preg_match('#^[A-Za-z]:/#', $normalized) || str_starts_with($normalized, '/')) {
            return $normalized;
        }

        // Anggap relatif terhadap storage/uploads.
        return self::basePath().'/'.$normalized;
    }

    /**
     * Ubah path absolut di dalam storage/uploads jadi URL publik /uploads/...
     */
    public static function toUrl(string $absolutePath): ?string
    {
        $base = str_replace('\\', '/', self::basePath());
        $normalized = str_replace('\\', '/', $absolutePath);

        if (! str_starts_with($normalized, $base)) {
            return null;
        }

        return '/uploads'.substr($normalized, strlen($base));
    }

    protected static function generateName(UploadedFile $file, ?string $forcedExtension = null): string
    {
        $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $slug = substr($slug !== '' ? $slug : 'file', 0, 60);
        $ext = strtolower($forcedExtension ?: $file->getClientOriginalExtension());

        return $slug.'-'.time().'-'.uniqid().'.'.$ext;
    }

    /**
     * Simpan gambar APAPUN (JPG/JPEG/PNG/WebP): resize maks 1200px +
     * kompres + konversi WAJIB ke WebP (GD, seperti sepeda-listrik).
     * Fallback: pindahkan file original bila GD gagal / mime tak dikenal.
     *
     * @return string path publik, contoh /uploads/news/xxx.webp
     */
    public static function storeImage(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 75): string
    {
        $directory = self::ensureDirectory($directory);
        $absoluteDir = self::basePath().'/'.$directory;

        // Coba konversi WebP via GD (pola sepeda-listrik).
        try {
            $info = @getimagesize($file->getPathname());

            if (is_array($info) && isset($info['mime'])) {
                $source = match ($info['mime']) {
                    'image/jpeg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($file->getPathname()) : false,
                    'image/png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($file->getPathname()) : false,
                    'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($file->getPathname()) : false,
                    'image/gif' => function_exists('imagecreatefromgif') ? @imagecreatefromgif($file->getPathname()) : false,
                    default => false,
                };

                if ($source) {
                    [$origWidth, $origHeight] = $info;
                    $origWidth = max(1, (int) $origWidth);
                    $origHeight = max(1, (int) $origHeight);

                    if ($origWidth <= $maxWidth) {
                        $newWidth = $origWidth;
                        $newHeight = $origHeight;
                    } else {
                        $ratio = $maxWidth / $origWidth;
                        $newWidth = $maxWidth;
                        $newHeight = max(1, (int) ($origHeight * $ratio));
                    }

                    $resized = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                    imagefill($resized, 0, 0, $transparent);
                    imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

                    $filename = self::generateName($file, 'webp');
                    $destPath = $absoluteDir.'/'.$filename;

                    if (function_exists('imagewebp') && @imagewebp($resized, $destPath, $quality)) {
                        imagedestroy($source);
                        imagedestroy($resized);

                        return '/uploads/'.$directory.'/'.$filename;
                    }

                    imagedestroy($source);
                    imagedestroy($resized);
                    @unlink($destPath);
                }
            }
        } catch (\Throwable) {
            // Lanjut ke fallback move original.
        }

        // Fallback: simpan original (seperti sepeda-listrik saat GD gagal).
        $filename = self::generateName($file);
        $file->move($absoluteDir, $filename);

        return '/uploads/'.$directory.'/'.$filename;
    }

    /**
     * Simpan file APAPUN (PDF/DOC/XLS/PPT/ZIP/gambar/file lain).
     *
     * @return array{path:string,filename:string,mime_type:?string,size:?int,format:string}
     */
    public static function storeFile(UploadedFile $file, string $directory = 'documents'): array
    {
        $directory = self::ensureDirectory($directory);
        $absoluteDir = self::basePath().'/'.$directory;

        // Capture metadata SEBELUM move (setelah move path tmp hilang, getMimeType gagal).
        $mime = $file->getMimeType();
        $size = $file->getSize();
        $format = strtoupper($file->getClientOriginalExtension());

        $filename = self::generateName($file);
        $file->move($absoluteDir, $filename);

        return [
            'path' => '/uploads/'.$directory.'/'.$filename,
            'filename' => $filename,
            'mime_type' => $mime,
            'size' => $size,
            'format' => $format,
        ];
    }

    /**
     * Hapus file fisik dari stored path. Aman bila file tidak ada.
     * Mendukung path baru /uploads/... dan legacy /storage/...
     */
    public static function delete(?string $storedPath): bool
    {
        $absolute = self::absolutePath($storedPath);

        if (! $absolute || ! File::exists($absolute) || ! is_file($absolute)) {
            return false;
        }

        // Proteksi: hanya hapus di dalam storage/uploads atau storage/app/public.
        $allowed = [str_replace('\\', '/', self::basePath()), str_replace('\\', '/', storage_path('app/public'))];
        $normalized = str_replace('\\', '/', $absolute);
        $inside = false;
        foreach ($allowed as $root) {
            if (str_starts_with($normalized, $root)) {
                $inside = true;
                break;
            }
        }

        if (! $inside) {
            return false;
        }

        return (bool) File::delete($absolute);
    }

    public static function exists(?string $storedPath): bool
    {
        $absolute = self::absolutePath($storedPath);

        return $absolute !== null && File::exists($absolute) && is_file($absolute);
    }

    /**
     * Daftar semua file di storage/uploads (rekursif), relatif terhadap base.
     * Contoh: news/xxx.webp, documents/yyy.pdf
     *
     * @return list<string>
     */
    public static function allRelativeFiles(): array
    {
        $base = self::basePath();

        if (! File::exists($base)) {
            return [];
        }

        return collect(File::allFiles($base))
            ->map(fn ($f) => ltrim(str_replace('\\', '/', substr($f->getPathname(), strlen($base))), '/'))
            ->filter(fn ($p) => $p !== '' && ! str_starts_with(basename($p), '.'))
            ->values()
            ->all();
    }
}
