<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use App\Support\ContentCache;
use App\Support\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * Base controller CMS: helper audit log, invalidasi cache konten,
 * upload gambar/dokumen yang aman, dan proteksi hapus file terpakai.
 */
abstract class BaseAdminController extends Controller
{
    protected function admin(): ?Admin
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Catat aksi admin. Password / token tidak pernah disimpan ke log.
     */
    protected function audit(string $action, ?Model $model, array $newValues = [], array $oldValues = []): void
    {
        $scrub = function (array $data): array {
            unset($data['password'], $data['password_confirmation'], $data['remember_token'], $data['remember']);

            return $data;
        };

        AuditLog::create([
            'auditable_type' => $model ? get_class($model) : null,
            'auditable_id' => $model?->getKey(),
            'user_id' => null,
            'action' => $action,
            'old_values' => array_merge($scrub($oldValues), [
                '_admin' => $this->admin()?->only(['id', 'name', 'email']),
            ]),
            'new_values' => array_merge($scrub($newValues), [
                '_admin' => $this->admin()?->only(['id', 'name', 'email']),
            ]),
            'ip_address' => request()->ip(),
        ]);
    }

    protected function flushContentCache(): void
    {
        ContentCache::flush();
    }

    /**
     * Simpan upload gambar APAPUN secara aman ala sepeda-listrik:
     * fisik di storage/uploads/{directory}, resize + konversi WebP (GD),
     * TANPA storage:link. Kembalikan path publik /uploads/...
     */
    protected function storeImage(UploadedFile $file, string $directory): string
    {
        return Uploads::storeImage($file, $directory);
    }

    /**
     * Simpan upload file APAPUN (PDF/DOC/XLS/PPT/ZIP/gambar/lainnya)
     * ala sepeda-listrik: fisik di storage/uploads/{directory} via move(),
     * TANPA storage:link. Kembalikan ['path','filename','mime_type','size','format'].
     * 'path' berupa URL publik /uploads/...
     */
    protected function storeDocument(UploadedFile $file, string $directory = 'documents'): array
    {
        return Uploads::storeFile($file, $directory);
    }

    /**
     * Hapus file fisik dari storage/uploads HANYA jika tidak dipakai konten lain.
     * $usages: array ['Label' => count]. Kembalikan error string atau null.
     * Mendukung path baru /uploads/... dan legacy /storage/...
     */
    protected function guardFileUsage(?string $storedPath, array $usages): ?string
    {
        if (! $storedPath) {
            return null;
        }

        $used = array_filter($usages, fn ($c) => $c > 0);

        if (! empty($used)) {
            $detail = collect($used)->map(fn ($c, $label) => "{$label} ({$c})")->implode(', ');

            return "File masih digunakan oleh: {$detail}. Nonaktifkan/arsipkan konten tersebut terlebih dahulu.";
        }

        Uploads::delete($storedPath);

        return null;
    }

    /**
     * Hapus file fisik secara langsung (untuk destroy hard-delete).
     */
    protected function deleteStoredFile(?string $storedPath): void
    {
        Uploads::delete($storedPath);
    }

    protected function imageRules(string $field = 'image', bool $required = false): array
    {
        return [$required ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
    }

    /**
     * Sanitasi HTML konten panjang (berita, deskripsi): izinkan tag format
     * dasar, buang <script>/<iframe>/<style> dan event handler / javascript:.
     */
    protected function sanitizeHtml(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        $html = preg_replace('#<(script|iframe|object|embed|style|link|meta)[^>]*>.*?</\1>#is', '', $html);
        $html = strip_tags($html, '<p><br><strong><em><u><ul><ol><li><a><h2><h3><h4><blockquote>');
        // Hapus event handler (onclick, onerror, ...)
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        // Netralkan javascript: pada href
        $html = preg_replace('/href\s*=\s*"\s*javascript:[^"]*"/i', 'href="#"', $html);
        $html = preg_replace("/href\s*=\s*'\s*javascript:[^']*'/i", "href='#'", $html);

        return trim($html);
    }
}
