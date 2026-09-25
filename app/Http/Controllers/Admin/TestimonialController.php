<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class TestimonialController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(Testimonial::class);
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,unpublished,published'],
        ]);

        $query = Testimonial::orderBy('sort_order')->orderByDesc('id');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.testimonials.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.testimonials.form', ['item' => new Testimonial]);
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeImage($request->file('avatar'), 'testimonials');
        }

        unset($data['remove_avatar']);

        $item = Testimonial::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.form', ['item' => $testimonial]);
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $old = $testimonial->toArray();
        $data = $request->validated();

        if ($request->boolean('remove_avatar') && $testimonial->avatar) {
            $this->guardFileUsage($testimonial->avatar, []);
            $data['avatar'] = null;
        } elseif ($request->hasFile('avatar')) {
            if ($testimonial->avatar) {
                $this->guardFileUsage($testimonial->avatar, []);
            }
            $data['avatar'] = $this->storeImage($request->file('avatar'), 'testimonials');
        } else {
            unset($data['avatar']);
        }

        unset($data['remove_avatar']);

        $testimonial->update($data);

        $this->audit('updated', $testimonial, $testimonial->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $old = $testimonial->toArray();
        $testimonial->delete();

        $this->audit('deleted', $testimonial, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni dihapus.');
    }
}
