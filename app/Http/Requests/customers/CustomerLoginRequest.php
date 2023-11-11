<?php

namespace App\Http\Requests\customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'phone' => 'required|numeric|digits_between:9,10|exists:customers,phone',
            'password' => 'required|min:6|max:100',
        ];
    }
}
