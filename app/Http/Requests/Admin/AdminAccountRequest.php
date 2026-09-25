<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminAccountRequest extends AdminRequest
{
    public function resourceModel(): string
    {
        return Admin::class;
    }

    public function rules(): array
    {
        $id = $this->route('admin')?->id;
        $isCreate = $this->isMethod('post');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($id)],
            'password' => [
                $isCreate ? 'required' : 'nullable',
                'string',
                Password::min(8)->mixedCase()->numbers(),
                'max:255',
                'confirmed',
            ],
            'role' => ['sometimes', 'string', Rule::in(\App\Models\Admin::ROLES)],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.min' => 'Password minimal 8 karakter.',
            'password.mixed' => 'Password harus mengandung huruf besar dan kecil.',
            'password.numbers' => 'Password harus mengandung angka.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'role.in' => 'Role tidak valid.',
        ];
    }
}
