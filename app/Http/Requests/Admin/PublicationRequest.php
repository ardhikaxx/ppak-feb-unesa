<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:500'],
            'authors' => ['required', 'string', 'max:500'],
            'publication_type' => ['nullable', 'string', 'max:50'],
            'journal_or_publisher' => ['nullable', 'string', 'max:255'],
            'publish_date' => ['nullable', 'date'],
            'year' => ['nullable', 'string', 'max:10'],
            'doi_or_url' => ['nullable', 'string', 'max:500'],
            'lecturer_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
