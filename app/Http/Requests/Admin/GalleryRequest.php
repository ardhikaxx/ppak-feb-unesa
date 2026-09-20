<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $gallery = $this->route('gallery');
        $id = is_object($gallery) ? $gallery->id : (is_numeric($gallery) ? (int) $gallery : ($gallery ? \App\Models\Gallery::where('slug', $gallery)->value('id') : null));

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('galleries', 'slug')->ignore($id)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'event_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
