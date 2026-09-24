<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('curriculum')?->id;

        return [
            'course_code' => ['required', 'string', 'max:30', Rule::unique('academic_curricula', 'course_code')->ignore($id)],
            'name_id' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'credits' => ['required', 'integer', 'min:0', 'max:12'],
            'course_type' => ['required', Rule::in(['Wajib', 'Pilihan', 'Paket Magang'])],
            'description' => ['nullable', 'string'],
            'cpl_mapping' => ['nullable', 'array'],
            'cpl_mapping.*' => ['string', 'max:20'],
            'instructors' => ['nullable', 'string', 'max:2000'],
            'curriculum_year' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }
}
