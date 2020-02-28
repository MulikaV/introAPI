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
}
