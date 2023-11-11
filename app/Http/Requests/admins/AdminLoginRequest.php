<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'phone'    => 'required|numeric|digits_between:9,10|exists:admins,phone',
            'password' => 'required|min:6|max:100',
        ];
    }
}
