<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:500'],
            'principal_investigator' => ['nullable', 'string', 'max:255'],
            'scheme' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'status' => ['required', Rule::in(['draft', 'unpublished', 'published'])],
            'description' => ['nullable', 'string'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
