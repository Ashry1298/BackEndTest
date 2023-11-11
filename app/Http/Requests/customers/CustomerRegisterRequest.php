<?php

namespace App\Http\Requests\customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'phone' => 'required|numeric|digits_between:9,10|unique:users,phone,NULL,',
            'email' => 'required|email|unique:users,email,NULL|max:50',
            'password' => 'required|min:6|max:100',
        ];
    }
}
