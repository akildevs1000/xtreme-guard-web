<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    use failedValidationWithName;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'is_active' => 'nullable|boolean',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug must be unique.',
            'img.image' => 'The image must be a valid image file.',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}
