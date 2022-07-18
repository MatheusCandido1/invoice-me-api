<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignUpRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'message'   => 'Validation Error',
                'data'      => $validator->errors()
            ]
        ));
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email already in use',
            'name.required' => 'Name is required',
            'password.required' => 'Password is required'
        ];
    }
}
