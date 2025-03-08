<?php

namespace App\Http\Requests\Employee;

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
            'last_name' => 'required',
            'employee_id' => 'required|unique:employees',
            'designation' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:employees',
            'branch' => 'nullable',
            'department' => 'nullable',
            'joining_date' => 'required',
            'country' => 'required',
            'description' => "nullable",

        ];
    }
}
