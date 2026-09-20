<?php

namespace App\Http\Requests\Admin;

use App\Models\PageContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('page_content')?->id;

        return [
            'page' => ['required', Rule::in(array_keys(PageContent::PAGES))],
            'section_key' => [
                'required', 'string', 'max:100', 'regex:/^[a-z0-9_\-]+$/',
                Rule::unique('page_contents', 'section_key')->where(fn ($q) => $q->where('page', $this->input('page')))->ignore($id),
            ],
            'heading' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['required', Rule::in(['published', 'draft'])],
        ];
    }

    public function messages(): array
    {
        return [
            'section_key.regex' => 'Kunci section hanya huruf kecil, angka, garis bawah, atau hubung.',
            'section_key.unique' => 'Kunci section sudah dipakai pada halaman ini.',
            'body.string' => 'Isi boleh HTML dasar (p, strong, em, ul, li, a, h2-h4). Script otomatis dibuang.',
        ];
    }
}
