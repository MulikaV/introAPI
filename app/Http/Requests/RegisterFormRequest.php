<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.t
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:filter', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6','regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/'],
        ];
    }

    public function messages()
    {
        return [
            'username' => 'Username is required',
            'email.required' => 'The email is required.',
            'email.email' => 'The email needs to have a valid format.',
            'email.unique' => 'This email is already registered in the system.',
            'password.required' => 'The password is required',
            'password.size' => 'The password must be at least 6 characters.',
            'password.regex' => 'Your password should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.'
        ];
    }
}
