<?php

namespace App\Http\Requests\Admin;

use App\Models\News;
use Illuminate\Validation\Rule;

class NewsRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return News::class;
    }

    public function rules(): array
    {
        $news = $this->route('news');
        $newsId = is_object($news) ? $news->id : (is_numeric($news) ? (int) $news : ($news ? \App\Models\News::where('slug', $news)->value('id') : null));

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('news', 'slug')->ignore($newsId)],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string', 'min:20'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'image' => array_merge($this->isMethod('post') ? [] : [], ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120']),
            'remove_image' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['draft', 'scheduled', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'tags' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_og_image' => ['nullable', 'boolean'],
            'robots_index' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-).',
            'slug.unique' => 'Slug sudah digunakan. Ubah judul atau slug.',
            'content.min' => 'Isi berita minimal 20 karakter.',
        ];
    }
}
