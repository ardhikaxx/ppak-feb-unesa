<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate(['q' => ['nullable', 'string', 'max:100']]);

        $files = collect(Storage::disk('public')->allFiles())
            ->filter(fn ($path) => ! str_starts_with(basename($path), '.'))
            ->map(function ($path) {
                $size = Storage::disk('public')->size($path);
                $mime = Storage::disk('public')->mimeType($path);
                $publicPath = '/storage/'.$path;

                return [
                    'path' => $path,
                    'name' => basename($path),
                    'dir' => dirname($path),
                    'size' => $size,
                    'size_human' => $this->humanSize($size),
                    'mime' => $mime,
                    'is_image' => str_starts_with($mime, 'image/'),
                    'url' => $publicPath,
                    'modified' => Storage::disk('public')->lastModified($path),
                    'usage' => $this->findUsage($publicPath, basename($path)),
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

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['path' => ['required', 'string', 'max:500']]);

        $path = ltrim($request->input('path'), '/');
        $path = preg_replace('#^storage/#', '', $path);

        // Cegah path traversal.
        if (str_contains($path, '..') || ! Storage::disk('public')->exists($path)) {
            return redirect()->route('admin.media.index')->with('error', 'File tidak ditemukan.');
        }

        $publicPath = '/storage/'.$path;
        $usage = $this->findUsage($publicPath, basename($path));

        if (! empty($usage)) {
            return redirect()->route('admin.media.index')
                ->with('error', 'File masih digunakan oleh: '.implode(', ', $usage).'. Hapus/nonaktifkan konten tersebut terlebih dahulu.');
        }

        Storage::disk('public')->delete($path);
        $this->audit('deleted', null, ['media_path' => $path]);

        return redirect()->route('admin.media.index')->with('success', 'File berhasil dihapus.');
    }

    /**
     * Lacak pemakaian file oleh konten aktif.
     */
    private function findUsage(string $publicPath, string $filename): array
    {
        $usage = [];

        $checks = [
            'Berita' => News::where('image', $publicPath)->count(),
            'Dosen' => Lecturer::where('image', $publicPath)->count(),
            'Galeri' => Gallery::where('image', $publicPath)->count(),
            'Dokumen' => Document::where(fn ($q) => $q->where('path', 'like', "%{$filename}")->orWhere('filename', $filename))->count(),
            'Testimoni' => Testimonial::where('avatar', $publicPath)->count(),
            'Mitra' => Partnership::where('logo', $publicPath)->count(),
        ];

        foreach ($checks as $label => $count) {
            if ($count > 0) {
                $usage[] = "{$label} ({$count})";
            }
        }

        return $usage;
    }

    private function humanSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2, ',', '.').' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1, ',', '.').' KB';
        }

        return $bytes.' B';
    }
}
