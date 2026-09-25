<?php

namespace App\Http\Requests\Admin;

use App\Models\CommunityService;
use Illuminate\Validation\Rule;

class CommunityServiceRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return CommunityService::class;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:500'],
            'leader_name' => ['nullable', 'string', 'max:255'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'status' => ['required', Rule::in(['draft', 'unpublished', 'published'])],
            'description' => ['nullable', 'string'],
        ];
    }
}
