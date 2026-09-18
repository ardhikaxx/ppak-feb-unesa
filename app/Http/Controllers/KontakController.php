<?php

namespace App\Http\Controllers;

use App\Contracts\ContentRepositoryInterface;
use App\Http\Requests\HelpdeskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KontakController extends Controller
{
    public function __construct(private ContentRepositoryInterface $content) {}

    public function lokasi(): View
    {
        return view('kontak.lokasi', [
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    public function helpdesk(): View
    {
        return view('kontak.helpdesk', [
            'info' => $this->content->getGeneralInfo(),
            'faqs' => array_slice($this->content->getFaq(), 0, 4),
        ]);
    }

    /**
     * Helpdesk submit - validated, rate limited, queue-ready.
     * Heavy work (email, logging) should be queued, not blocking request.
     */
    public function submitHelpdesk(HelpdeskRequest $request)
    {
        $validated = $request->validated();

        // Dispatch job for email/notification (queue-ready)
        // HelpdeskMessageJob::dispatch($validated);

        // For now, log and return with success (scalable to queue)
        \Illuminate\Support\Facades\Log::info('Helpdesk inquiry received', $validated);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Tim helpdesk akan merespons dalam 1x24 jam kerja.');
    }

    public function unduhan(Request $request): View
    {
        $request->validate([
            'kategori' => ['nullable', 'string', 'max:50'],
            'q' => ['nullable', 'string', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $perPage = config('ppak.pagination.dokumen', 10);
        $category = $request->query('kategori');
        $search = $request->query('q');

        $paginated = $this->content->getUnduhanPaginated($perPage, $category);

        // If search, filter additionally at data layer (server-side)
        if ($search) {
            $items = $this->content->getUnduhan();
            $lower = mb_strtolower($search);
            $filtered = array_filter($items, fn($doc) =>
                str_contains(mb_strtolower($doc['title']), $lower) ||
                str_contains(mb_strtolower($doc['kategori']), $lower)
            );
            $paginated = \App\Support\ArrayPaginator::paginate(array_values($filtered), $perPage);
        }

        return view('kontak.unduhan', [
            'unduhan' => $paginated,
            'info' => $this->content->getGeneralInfo(),
        ]);
    }

    /**
     * Secure file download - validates via signed route, streams via Filesystem.
     * Ready for S3/CDN without changing business logic.
     */
    public function download(string $filename): StreamedResponse|\Illuminate\Http\RedirectResponse
    {
        $all = $this->content->getUnduhan();
        $doc = collect($all)->firstWhere('filename', $filename);

        if (!$doc) {
            abort(404);
        }

        // Files are stored in storage/app/public/documents or public/documents
        // Use Filesystem abstraction - local now, S3 later
        $disk = Storage::disk(config('filesystems.default') === 'local' ? 'public' : config('filesystems.default'));
        $path = 'documents/' . $filename;

        if (!$disk->exists($path) && !file_exists(public_path('documents/' . $filename))) {
            // Fallback: file not yet on storage, show 404 with empty state
            abort(404, 'Dokumen tidak tersedia di storage.');
        }

        // Stream download - efficient for large files, not loading into memory
        if ($disk->exists($path)) {
            return Storage::disk($disk === Storage::disk('public') ? 'public' : config('filesystems.default'))->download($path, $doc['title'] . '.pdf');
        }

        return response()->download(public_path('documents/' . $filename), $doc['title'] . '.pdf');
    }
}
