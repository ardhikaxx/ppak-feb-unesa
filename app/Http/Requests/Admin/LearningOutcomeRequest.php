<?php

namespace App\Http\Requests\Admin;

use App\Models\LearningOutcome;
use Illuminate\Validation\Rule;

class LearningOutcomeRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return LearningOutcome::class;
    }

    public function rules(): array
    {
        $id = $this->route('learning_outcome')?->id;

        return [
            'code' => ['required', 'string', 'max:20', Rule::unique('learning_outcomes', 'code')->ignore($id)],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }
}
