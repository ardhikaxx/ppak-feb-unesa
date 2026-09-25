<?php

namespace App\Http\Requests\Admin;

use App\Models\Publication;

class PublicationRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Publication::class;
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
