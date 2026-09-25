<?php

namespace App\Http\Requests\Admin;

use App\Models\Testimonial;
use Illuminate\Validation\Rule;

class TestimonialRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Testimonial::class;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:10'],
            'quote' => ['required', 'string', 'min:10'],
            'status' => ['required', Rule::in(['draft', 'unpublished', 'published'])],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'quote.min' => 'Isi testimoni minimal 10 karakter. Hanya tampilkan testimoni terverifikasi dari alumni.',
        ];
    }
}
