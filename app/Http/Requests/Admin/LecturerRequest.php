<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LecturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $lecturer = $this->route('lecturer');
        $id = is_object($lecturer) ? $lecturer->id : (is_numeric($lecturer) ? (int) $lecturer : ($lecturer ? \App\Models\Lecturer::where('slug', $lecturer)->value('id') : null));

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('lecturers', 'slug')->ignore($id)],
            'gelar' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'category' => ['required', Rule::in(['auditing', 'keuangan', 'perpajakan', 'manajemen'])],
            'category_label' => ['nullable', 'string', 'max:255'],
            'bidang' => ['nullable', 'string', 'max:500'],
            'matkul' => ['nullable', 'string', 'max:1000'],
            'email' => ['nullable', 'email', 'max:255'],
            'sertifikasi' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-).',
            'matkul.string' => 'Tulis mata kuliah dipisahkan koma.',
        ];
    }
}
