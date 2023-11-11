<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'phone' => 'required|numeric|digits_between:9,10|unique:admins,phone,NULL,',
            'email' => 'required|email|unique:admins,email,NULL|max:50',
            'password' => 'required|min:6|max:100',
        ];
    }
}
