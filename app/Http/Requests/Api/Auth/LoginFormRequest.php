<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email:filter'],
            'password' => ['required', 'string', 'min:6','regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/'],
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'The email is required.',
            'email.email' => 'The email needs to have a valid format.',
            'email.exists' => 'The email is not registered in the system.',
            'password.required' => 'The password is required',
            'password.size' => 'The password must be at least 6 characters.',
            'password.regex' => 'Your password should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.'
        ];
    }

}
