<?php

namespace App\Http\Requests\Blog;

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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug must be a string.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'slug.unique' => 'The slug has already been taken.',
            'author.required' => 'The author is required.',
            'author.string' => 'The author must be a string.',
            'author.max' => 'The author may not be greater than 255 characters.',
            'category.required' => 'The category is required.',
            'category.string' => 'The category must be a string.',
            'category.max' => 'The category may not be greater than 255 characters.',
            'content.required' => 'The content is required.',
            'content.string' => 'The content must be a string.',
            'status.required' => 'The status is required.',
            'status.boolean' => 'The status must be true or false.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }
}
