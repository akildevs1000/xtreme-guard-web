<?php

namespace App\Http\Requests\Category;

use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    use failedValidationWithName;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'string|unique:categories,slug|max:255',
            // 'img1' => 'required|image|mimes:jpg,jpeg,png,gif',
            // 'img1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=300,height=300',

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
            // 'img.image' => 'The image must be a valid image file.',
            'img1.dimensions' => 'The image size should be 300 x 300',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}
