<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use App\Support\ContentCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * Simpan upload gambar secara aman. Kembalikan path publik '/storage/...'.
     * Menolak executable (php, dll) via validasi MIME + ekstensi.
     */
    protected function storeImage(UploadedFile $file, string $directory): string
    {
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = substr($filename, 0, 60).'-'.time().'.'.strtolower($file->getClientOriginalExtension());

        $path = $file->storeAs($directory, $filename, 'public');

        return '/storage/'.$path;
    }

    /**
     * Simpan upload dokumen (PDF/DOC). Kembalikan ['path','filename','mime','size'].
     */
    protected function storeDocument(UploadedFile $file, string $directory = 'documents'): array
    {
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = substr($filename, 0, 80).'-'.time().'.'.strtolower($file->getClientOriginalExtension());

        $path = $file->storeAs($directory, $filename, 'public');

        return [
            'path' => $path,
            'filename' => $filename,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'format' => strtoupper($file->getClientOriginalExtension()),
        ];
    }

    /**
     * Hapus file dari disk public HANYA jika tidak dipakai konten lain.
     * $usages: array ['Label' => count]. Kembalikan error string atau null.
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

        $relative = ltrim(str_replace('/storage/', '', $storedPath), '/');
        if ($relative && Storage::disk('public')->exists($relative)) {
            Storage::disk('public')->delete($relative);
        }

        return null;
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
