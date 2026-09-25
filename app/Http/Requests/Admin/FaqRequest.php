<?php

namespace App\Http\Requests\Admin;

use App\Models\FAQ;

class FaqRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return FAQ::class;
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:50'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }
}
