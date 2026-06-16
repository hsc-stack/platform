<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (!$this->filled('password')) {
            $this->replace($this->except('password'));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name'        => ['sometimes', 'string', 'max:255'],
            'email'       => ['sometimes', 'email', 'unique:users,email,' . $user->id],
            'password'    => ['sometimes', 'nullable', 'string', 'min:6'],
            'role'        => ['sometimes', 'string'],

            'image'       => ['sometimes', 'nullable', 'string', 'max:255'],
            'about'       => ['sometimes', 'nullable', 'string'],
            'title'       => ['sometimes', 'nullable', 'string'],
            'institution' => ['sometimes', 'nullable', 'string', 'max:255'],
            'facebook'    => ['sometimes', 'nullable', 'string', 'max:255'],
            'instagram'    => ['sometimes', 'nullable', 'string', 'max:255'],
            'github'      => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
