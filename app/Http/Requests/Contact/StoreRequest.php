<?php

namespace App\Http\Requests\Contact;

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
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'message' => 'required|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'The name field is required.',
            'email.required'   => 'The email field is required.',
            'email.email'      => 'Please enter a valid email address.',
            'message.required' => 'The message field is required.',
            'message.min'      => 'The message must be at least 10 characters long.',
        ];
    }
}
