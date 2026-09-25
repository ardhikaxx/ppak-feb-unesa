<?php

namespace App\Http\Requests\Admin;

use App\Models\AlumniRecord;
use Illuminate\Validation\Rule;

class AlumniRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return AlumniRecord::class;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'string', 'max:10'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'current_position' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'unpublished', 'published'])],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Nama alumni wajib diisi dengan data resmi (tanpa data fiktif).',
        ];
    }
}
