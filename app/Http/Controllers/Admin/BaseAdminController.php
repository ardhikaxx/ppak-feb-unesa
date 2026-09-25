<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use App\Support\ContentCache;
use App\Support\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Base controller CMS: helper audit log, invalidasi cache konten,
 * upload gambar/dokumen yang aman, dan proteksi hapus file terpakai.
 */
abstract class BaseAdminController extends Controller
{
    /**
     * Middleware otorisasi Laravel Policy untuk controller resource CRUD.
     *
     * Dipakai bersama HasMiddleware pada masing-masing controller
     * (pengganti authorizeResource(), yang butuh Illuminate\Routing\Controller
     * untuk mendaftarkan middleware instance — base controller aplikasi
     * tidak mewarisinya sejak skeleton Laravel 11).
     *
     * Ability mengikuti resourceAbilityMap() Laravel:
     * index=viewAny, show=view, create/store=create,
     * edit/update=update, destroy=delete, restore=restore.
     * Kolom `restore` bukan bagian resource route default sehingga
     * didaftarkan eksplisit di sini, dan sengaja memakai class-string
     * ($model, bukan $parameter): route restore menerima id/slug mentah
     * (tanpa type-hint model), sehingga argumen route tidak akan pernah
     * cocok dengan policy — sedangkan ability lain selalu punya
     * implicit binding bertipe model pada signature controller.
     */
    protected static function resourceMiddleware(string $model, ?string $parameter = null): array
    {
        $parameter = $parameter ?: Str::snake(class_basename($model));

        return [
            new Middleware("can:viewAny,{$model}", only: ['index']),
            new Middleware("can:view,{$parameter}", only: ['show']),
            new Middleware("can:create,{$model}", only: ['create', 'store']),
            new Middleware("can:update,{$parameter}", only: ['edit', 'update']),
            new Middleware("can:delete,{$parameter}", only: ['destroy']),
            new Middleware("can:restore,{$model}", only: ['restore']),
        ];
    }

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
     * Sanitasi HTML konten panjang (berita) berbasis parser DOM:
     * allowlist tag + atribut, buang node berbahaya (script/iframe/dll)
     * dan skema berbahaya pada href (javascript:, vbscript:, data:).
     */
    protected function sanitizeHtml(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        $allowedTags = ['p', 'br', 'strong', 'em', 'u', 'ul', 'ol', 'li', 'a', 'h2', 'h3', 'h4', 'blockquote'];
        $allowedAttributes = ['href', 'title', 'target', 'rel'];
        $dropWithContent = ['script', 'style', 'iframe', 'object', 'embed', 'link', 'meta', 'form', 'input', 'button', 'textarea', 'select', 'svg', 'math', 'template', 'noscript'];

        $previous = libxml_use_internal_errors(true);
        $document = new \DOMDocument();
        $document->loadHTML(
            '<!DOCTYPE html><html><body id="sanitize-root">'.$html.'</body></html>',
            LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $document->getElementsByTagName('body')->item(0);
        if (! $root) {
            return trim(strip_tags($html));
        }

        $filter = function (\DOMNode $node) use (&$filter, $allowedTags, $allowedAttributes, $dropWithContent): void {
            if (! $node->hasChildNodes()) {
                return;
            }

            foreach (iterator_to_array($node->childNodes) as $child) {
                if ($child instanceof \DOMElement) {
                    $tag = strtolower($child->nodeName);

                    if (in_array($tag, $dropWithContent, true)) {
                        $child->parentNode?->removeChild($child);

                        continue;
                    }

                    if (! in_array($tag, $allowedTags, true)) {
                        // Lift: buang tag, pertahankan isinya.
                        $parent = $child->parentNode;
                        if ($parent) {
                            while ($child->firstChild) {
                                $parent->insertBefore($child->firstChild, $child);
                            }
                            $parent->removeChild($child);
                        }

                        // Anak yang di-lift ke parent tetap perlu difilter.
                        continue;
                    }

                    $remove = [];
                    foreach (iterator_to_array($child->attributes) as $attribute) {
                        $name = strtolower($attribute->name);
                        $value = trim($attribute->value);

                        if (! in_array($name, $allowedAttributes, true)) {
                            $remove[] = $attribute->name;

                            continue;
                        }

                        if (in_array($name, ['href', 'src'], true) && preg_match('/^\s*(javascript|vbscript|data)\s*:/i', $value)) {
                            $remove[] = $attribute->name;
                        }
                    }

                    foreach ($remove as $name) {
                        $child->removeAttribute($name);
                    }

                    if ($tag === 'a') {
                        $href = $child->getAttribute('href');
                        if ($href === '' || preg_match('/^\s*(javascript|vbscript|data)\s*:/i', $href)) {
                            $child->removeAttribute('href');
                        }
                        $child->setAttribute('rel', 'noopener noreferrer');
                        if ($child->hasAttribute('target')) {
                            $child->setAttribute('target', '_blank');
                        }
                    }
                }

                if ($child->parentNode) {
                    $filter($child);
                }
            }
        };

        $filter($root);

        $result = '';
        foreach (iterator_to_array($root->childNodes) as $child) {
            $result .= $document->saveHTML($child);
        }

        return trim($result);
    }
}
