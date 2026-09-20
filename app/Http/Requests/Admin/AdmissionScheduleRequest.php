<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdmissionScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'academic_year' => ['required', 'string', 'max:20', 'regex:/^\d{4}\/\d{4}$/'],
            'wave_name' => ['required', 'string', 'max:50'],
            'period_label' => ['nullable', 'string', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'verification_date' => ['nullable', 'date'],
            'exam_date' => ['nullable', 'date'],
            'announcement_date' => ['nullable', 'date'],
            'registration_deadline' => ['nullable', 'date'],
            'course_start_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'upcoming', 'archived'])],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'academic_year.regex' => 'Format tahun akademik: 2026/2027.',
        ];
    }
}
