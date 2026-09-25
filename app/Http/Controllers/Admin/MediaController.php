<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\Testimonial;
use App\Support\Format;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class MediaController extends BaseAdminController
{
    /**
     * Media / File Manager ala sepeda-listrik:
     * list semua file fisik di storage/uploads (TANPA storage:link).
     */
    public function index(Request $request): View
    {
        $request->validate(['q' => ['nullable', 'string', 'max:100']]);

        $files = collect(Uploads::allRelativeFiles())
            ->map(function ($relative) {
                $absolute = Uploads::basePath().'/'.$relative;
                $size = File::exists($absolute) ? File::size($absolute) : 0;
                $mime = File::exists($absolute) ? (File::mimeType($absolute) ?: 'application/octet-stream') : 'application/octet-stream';
                $publicPath = '/uploads/'.$relative;

                return [
                    'path' => $relative, // relatif terhadap storage/uploads, dipakai form hapus
                    'name' => basename($relative),
                    'dir' => dirname($relative),
                    'size' => $size,
                    'size_human' => Format::bytes($size),
                    'mime' => $mime,
                    'is_image' => str_starts_with($mime, 'image/'),
                    'url' => $publicPath,
                    'modified' => File::exists($absolute) ? File::lastModified($absolute) : time(),
                    'usage' => $this->findUsage($publicPath, basename($relative)),
                ];
            })
            ->sortByDesc('modified')
            ->values();

        if ($request->filled('q')) {
            $q = mb_strtolower($request->input('q'));
            $files = $files->filter(fn ($f) => str_contains(mb_strtolower($f['name']), $q))->values();
        }

        return view('admin.media.index', ['files' => $files]);
    }

    /**
     * Hapus file APAPUN (gambar/file) ala sepeda-listrik: File::delete
     * dari storage/uploads, ditolak bila masih dipakai konten.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['path' => ['required', 'string', 'max:500']]);

        $relative = ltrim(str_replace('\\', '/', $request->input('path')), '/');
        $relative = preg_replace('#^(uploads|storage)/#', '', $relative);

        // Cegah path traversal.
        if (str_contains($relative, '..') || $relative === '' || ! Uploads::exists('/uploads/'.$relative)) {
            return redirect()->route('admin.media.index')->with('error', 'File tidak ditemukan.');
        }

        $publicPath = '/uploads/'.$relative;
        $usage = $this->findUsage($publicPath, basename($relative));

        if (! empty($usage)) {
            return redirect()->route('admin.media.index')
                ->with('error', 'File masih digunakan oleh: '.implode(', ', $usage).'. Hapus/nonaktifkan konten tersebut terlebih dahulu.');
        }

        Uploads::delete($publicPath);
        $this->audit('deleted', null, ['media_path' => $publicPath]);

        return redirect()->route('admin.media.index')->with('success', 'File berhasil dihapus.');
    }

    /**
     * Lacak pemakaian file oleh konten aktif.
     * Cek varian baru /uploads/... dan legacy /storage/... agar file lama tetap terproteksi.
     */
    private function findUsage(string $publicPath, string $filename): array
    {
        $legacyPath = '/storage/'.ltrim(substr($publicPath, strlen('/uploads/')), '/');
        $paths = [$publicPath, $legacyPath];

        $usage = [];

        $checks = [
            'Berita' => News::whereIn('image', $paths)->count(),
            'Dosen' => Lecturer::whereIn('image', $paths)->count(),
            'Galeri' => Gallery::whereIn('image', $paths)->count(),
            'Dokumen' => Document::where(fn ($q) => $q->where('path', 'like', "%{$filename}")->orWhere('filename', $filename))->count(),
            'Testimoni' => Testimonial::whereIn('avatar', $paths)->count(),
            'Mitra' => Partnership::whereIn('logo', $paths)->count(),
        ];

        foreach ($checks as $label => $count) {
            if ($count > 0) {
                $usage[] = "{$label} ({$count})";
            }
        }

        return $usage;
    }
}
