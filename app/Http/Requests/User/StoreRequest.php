<?php

namespace App\Http\Requests\User;

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
            'first_name' => 'required',
            'last_name' => 'nullable',
            'username' => 'required',
            'id' => 'required|unique:employees',
            'designation' => 'required',
            'contact' => 'nullable',
            'email' => 'required|email|unique:employees',
            'is_active' => 'required',
            'joining_date' => 'required',
            'description' => "nullable",
            'img' => "nullable",
            'password'     => [
                'required',
                'string',
                'confirmed',
                'min:6', // must be at least 10 characters in length
                'max:25', // must be maximum 25 characters in length
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
    }
}
