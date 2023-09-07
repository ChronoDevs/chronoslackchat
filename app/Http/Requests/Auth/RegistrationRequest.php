<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required',
            'firstname' => 'required|min:2|max:100',
            'middlename' => 'nullable|min:2|max:100',
            'lastname' => 'required|min:2|max:100',
            'suffix' => 'nullable|min:2|max:20',
            'birthdate' => 'date|nullable',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'phone' => ['nullable', 'regex:/^09\d{9}$/'],
        ];
    }
}
