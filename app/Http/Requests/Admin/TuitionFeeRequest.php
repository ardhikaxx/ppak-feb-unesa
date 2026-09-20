<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TuitionFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'program_name' => ['required', 'string', 'max:255'],
            'fee_type' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'integer', 'min:0', 'max:1000000000'],
            'currency' => ['nullable', 'string', 'max:10'],
            'period' => ['nullable', 'string', 'max:30'],
            'academic_year' => ['required', 'string', 'max:20', 'regex:/^\d{4}\/\d{4}$/'],
            'description' => ['nullable', 'string'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
