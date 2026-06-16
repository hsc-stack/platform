<?php

namespace App\Http\Requests\Resource;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'redirect'      => ['nullable', 'string'],
            'node_id'       => ['sometimes', 'integer', 'exists:nodes,id'],
            'resource_type' => ['sometimes', 'in:note,question,pdf,image,video'],
            'title'         => ['sometimes', 'string', 'max:100', 'min:2'],
            'content'       => ['sometimes', 'nullable', 'string'],
            'file'          => ['sometimes', 'nullable', 'file', 'max:10000', 'mimes:jpg,jpeg,png'],
        ];
    }
}
