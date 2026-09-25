<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Base form request CMS: otorisasi PER-RESOURCE lewat Policy,
 * bukan sekadar cek "sudah login atau belum".
 *
 * Ability dipilih otomatis: request yang membawa model ter-binding
 * (update) memakai `update`, sedangkan request tanpa model binding
 * (store / form singleton) memakai `create`.
 */
abstract class AdminRequest extends FormRequest
{
    /**
     * Model yang menjadi objek otorisasi request ini.
     */
    abstract public function resourceModel(): string;

    public function authorize(): bool
    {
        $admin = $this->user('admin');

        if (! $admin) {
            return false;
        }

        $modelClass = $this->resourceModel();
        $model = collect($this->route()->parameters())
            ->first(fn ($value) => $value instanceof $modelClass);

        return $model !== null
            ? $admin->can('update', $model)
            : $admin->can('create', $modelClass);
    }
}
