<?php

namespace App\Http\Requests\Product;

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
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku|max:255',
            'brand_id' => 'nullable|string|max:255',
            'category_id' => 'required|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'tags' => 'nullable',
            // 'status' => 'nullable|string|in:active,inactive',
            'main_image' => 'nullable|string|max:255',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug|max:255',
            'warranty' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'specifications' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',

            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,png',
            // 'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',

            // 'images' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
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
