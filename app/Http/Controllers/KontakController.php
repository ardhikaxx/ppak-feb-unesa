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
     * Secure file download - streams via Filesystem or public storage.
     * Ready for local/S3 without changing business logic.
     */
    public function download(string $filename): \Symfony\Component\HttpFoundation\Response
    {
        $all = $this->content->getUnduhan();
        $doc = collect($all)->firstWhere('filename', $filename);

        if (!$doc) {
            abort(404, 'Informasi berkas tidak ditemukan.');
        }

        $sanitizedName = preg_replace('/[^\w\s\-\.]/u', '', $doc['title'] ?? 'dokumen-resmi-ppak') . '.pdf';

        // Check in public/documents first
        $publicFilePath = public_path('documents/' . $filename);
        if (file_exists($publicFilePath)) {
            return response()->download($publicFilePath, $sanitizedName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $sanitizedName . '"',
            ]);
        }

        // Fallback check in storage/app/public/documents
        $disk = Storage::disk('public');
        $path = 'documents/' . $filename;
        if ($disk->exists($path)) {
            return $disk->download($path, $sanitizedName, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        abort(404, 'Dokumen fisik belum tersedia di repositori server.');
    }
}

