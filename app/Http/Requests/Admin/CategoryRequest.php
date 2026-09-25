<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Category::class;
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('categories', 'slug')->ignore($id)],
            'type' => ['required', Rule::in(['news', 'agenda', 'document', 'gallery'])],
            'color' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }
}
