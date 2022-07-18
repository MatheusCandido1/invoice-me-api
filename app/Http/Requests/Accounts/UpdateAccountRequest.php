<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAccountRequest extends FormRequest
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
            'number' => 'required',
            'beneficiary' => 'required',
            'bic_code' => 'required'
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
            'number.required' => 'Number is required',
            'beneficiary.required' => 'Beneficiary is required',
            'bic_code.required' => 'BIC Code is required'
        ];
    }
}
