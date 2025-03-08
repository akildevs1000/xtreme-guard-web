<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
        $userId = $this->route('user')->id;
        return [
            'first_name'   => 'required',
            'last_name'    => 'nullable',
            'username'     => 'required',
            'designation'  => 'required',
            'contact'      => 'nullable',
            'is_active'    => 'required',
            'email'        => ['required', 'string', Rule::unique('users')->ignore($userId)],
            'joining_date' => 'required',
            'description'  => "nullable",
            'img'          => "nullable",
            'is_create_ship_allow' => "nullable",
            'is_create_return_allow' => "nullable",
            'password'     => [
                // 'required',
                'string',
                'nullable',
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
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_create_ship_allow' => $this->has('is_create_ship_allow') ? 1 : 0,
            'is_create_return_allow' => $this->has('is_create_return_allow') ? 1 : 0,
        ]);
    }
}
