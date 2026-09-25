<?php

namespace App\Http\Requests\Admin;

use App\Models\Research;
use Illuminate\Validation\Rule;

class ResearchRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Research::class;
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
        ];
    }
}
