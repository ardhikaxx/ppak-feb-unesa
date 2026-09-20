<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:50'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
