<?php

namespace App\Http\Requests\Admin;

use App\Models\Accreditation;

class AccreditationRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Accreditation::class;
    }

    public function rules(): array
    {
        return [
            'program_name' => ['required', 'string', 'max:255'],
            'agency' => ['required', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:50'],
            'decree_number' => ['required', 'string', 'max:255'],
            'decree_date' => ['nullable', 'date'],
            'effective_from' => ['nullable', 'date'],
            'effective_until' => ['nullable', 'date', 'after_or_equal:effective_from'],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
