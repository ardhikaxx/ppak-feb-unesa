<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('document')?->id;
        $isCreate = $this->isMethod('post');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('documents', 'slug')->ignore($id)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'file' => [$isCreate ? 'required' : 'nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip', 'max:10240'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Format file harus PDF/DOC/XLS/PPT/ZIP. File executable (PHP, dsb) tidak diizinkan.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
