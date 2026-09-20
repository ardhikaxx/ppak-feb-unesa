<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'program_code' => ['required', 'string', 'max:20'],
            'program_name' => ['required', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:50'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'university' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:50'],
            'established_date' => ['nullable', 'date'],
            'coordinator_name' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'office_hours' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'url', 'max:500'],
            'social_instagram_feb' => ['nullable', 'url', 'max:500'],
            'social_youtube' => ['nullable', 'url', 'max:500'],
            'social_tiktok' => ['nullable', 'url', 'max:500'],
            'social_facebook' => ['nullable', 'url', 'max:500'],
            'social_linkedin' => ['nullable', 'url', 'max:500'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
