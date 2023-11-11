<?php

namespace App\Http\Requests\transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'          => 'required|exists:categories,id',
            'sub_category_id'      => 'required|exists:categories,id',
            'amount'               => 'required|numeric',
            'customer_id'          => 'required|exists:customers,id',
            'due_on'               => 'required|date|after_or_equal:' . date('Y-m-d'),
            'vat'                  => 'required|numeric',
            'is_vat_inclusive'     => 'required|in:0,1',
        ];
    }
}
