<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $agenda = $this->route('agenda');
        $id = is_object($agenda) ? $agenda->id : (is_numeric($agenda) ? (int) $agenda : ($agenda ? \App\Models\Agenda::where('slug', $agenda)->value('id') : null));

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', Rule::unique('agendas', 'slug')->ignore($id)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'event_date' => ['required', 'date'],
            'event_end_date' => ['nullable', 'date', 'after_or_equal:event_date'],
            'time' => ['nullable', 'string', 'max:100'],
            'venue' => ['nullable', 'string', 'max:255'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['upcoming', 'ongoing', 'completed', 'cancelled'])],
            'is_upcoming' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'source_name' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'robots_index' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-).',
            'slug.unique' => 'Slug sudah digunakan.',
            'event_end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ];
    }
}
