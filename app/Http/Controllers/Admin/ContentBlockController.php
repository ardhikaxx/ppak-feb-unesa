<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContentBlockRequest;
use App\Models\ContentBlock;
use App\Services\PpakData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentBlockController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'group' => ['nullable', 'in:karier,tahapan,persyaratan'],
            'status' => ['nullable', 'in:published,draft'],
        ]);

        $group = $request->input('group', 'karier');

        $query = ContentBlock::ofGroup($group)->ordered();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(15)->withQueryString();
        // Jumlah data bawaan (fallback) agar admin tahu posisi awal.
        $fallbackCount = count($this->defaults($group));

        return view('admin.content-blocks.index', compact('items', 'group', 'fallbackCount'));
    }

    public function create(Request $request): View
    {
        $request->validate(['group' => ['nullable', 'in:karier,tahapan,persyaratan']]);

        $item = new ContentBlock(['group' => $request->input('group', 'karier')]);

        return view('admin.content-blocks.form', compact('item'));
    }

    public function store(ContentBlockRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['meta'] = null;

        $item = ContentBlock::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.content-blocks.index', ['group' => $item->group])
            ->with('success', 'Blok konten berhasil ditambahkan dan langsung tampil di website.');
    }

    public function edit(ContentBlock $contentBlock): View
    {
        return view('admin.content-blocks.form', ['item' => $contentBlock]);
    }

    public function update(ContentBlockRequest $request, ContentBlock $contentBlock): RedirectResponse
    {
        $old = $contentBlock->toArray();
        $data = $request->validated();
        $data['meta'] = $contentBlock->meta;

        $contentBlock->update($data);

        $this->audit('updated', $contentBlock, $contentBlock->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.content-blocks.index', ['group' => $contentBlock->group])
            ->with('success', 'Blok konten berhasil diperbarui.');
    }

    public function destroy(ContentBlock $contentBlock): RedirectResponse
    {
        $group = $contentBlock->group;
        $old = $contentBlock->toArray();
        $contentBlock->delete();

        $this->audit('deleted', $contentBlock, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.content-blocks.index', ['group' => $group])
            ->with('success', 'Blok konten dihapus. Bila grup kosong, website kembali memakai data bawaan.');
    }

    /**
     * Salin data bawaan (master terverifikasi) menjadi baris yang bisa diedit.
     * Idempotent: judul yang sudah ada tidak diduplikasi.
     */
    public function import(string $group): RedirectResponse
    {
        abort_unless(array_key_exists($group, ContentBlock::GROUPS), 404);

        $count = 0;
        foreach ($this->defaults($group) as $i => $row) {
            $exists = ContentBlock::ofGroup($group)->where('title', $row['title'])->exists();
            if (! $exists) {
                ContentBlock::create(array_merge($row, [
                    'group' => $group,
                    'sort_order' => $i + 1,
                    'status' => 'published',
                ]));
                $count++;
            }
        }

        $this->flushContentCache();

        return redirect()->route('admin.content-blocks.index', ['group' => $group])
            ->with('success', "Berhasil mengimpor {$count} data bawaan. Silakan ubah sesuai kebutuhan.");
    }

    /**
     * Data bawaan dari master terverifikasi (read-only reference).
     *
     * @return array<int, array{title: string, description: ?string, icon: ?string, meta: ?array}>
     */
    private function defaults(string $group): array
    {
        return match ($group) {
            'karier' => collect(PpakData::getKarierSectors())->map(fn ($k) => [
                'title' => $k['title'],
                'description' => $k['desc'],
                'icon' => $k['icon'],
                'meta' => null,
            ])->all(),
            'tahapan' => collect(PpakData::getAdmisiInfo()['tahapan_pendaftaran'])->map(fn ($t) => [
                'title' => $t['judul'],
                'description' => $t['deskripsi'],
                'icon' => null,
                'meta' => null,
            ])->all(),
            'persyaratan' => collect(PpakData::getAdmisiInfo()['persyaratan_umum'])->map(fn ($p) => [
                'title' => $p,
                'description' => null,
                'icon' => null,
                'meta' => null,
            ])->all(),
            default => [],
        };
    }
}
