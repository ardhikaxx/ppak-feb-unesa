<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentBlockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'group' => ['required', Rule::in(['karier', 'tahapan', 'persyaratan'])],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100', 'regex:/^[a-z0-9\- ]+$/'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['required', Rule::in(['published', 'draft'])],
        ];
    }

    public function messages(): array
    {
        return [
            'icon.regex' => 'Ikon diisi kelas Font Awesome, mis. fa-certificate.',
        ];
    }
}
