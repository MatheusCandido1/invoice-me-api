<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreCustomerRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required',
            'email' => 'required',
            'address.zipcode' => 'required',
            'address.state' => 'required',
            'address.city' => 'required',
            'address.address' => 'required',
            'address.number' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'message' => 'Validation Error',
                'data'  => $validator->errors()
            ]
        ));
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'code.required' => 'Code is required',
            'email.required' => 'E-mail is required',
            'address.zipcode.required' => 'Zipcode is required',
            'address.state.required' => 'State is required',
            'address.city.required' => 'City is required',
            'address.address.required' => 'Address is required',
            'address.number.required' => 'Number is required',
        ];
    }
}
