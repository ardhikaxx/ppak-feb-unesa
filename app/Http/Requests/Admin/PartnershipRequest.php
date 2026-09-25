<?php

namespace App\Http\Requests\Admin;

use App\Models\Partnership;
use Illuminate\Validation\Rule;

class PartnershipRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Partnership::class;
    }

    public function rules(): array
    {
        return [
            'partner_name' => ['required', 'string', 'max:255'],
            'partner_category' => ['nullable', 'string', 'max:50'],
            'collaboration_type' => ['nullable', 'string', 'max:255'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'status' => ['required', Rule::in(['draft', 'unpublished', 'active', 'archived'])],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
