<?php
namespace App\Http\Requests\transactions;


use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'category_id' => '',
            'sub_category_id' => '',
            'status' => '',
            'amount' => '',
            'payer' => '',
            'due_on' => '',
            'vat' => '',
            'is_vat_inclusive' => '',
        ];
    }
}
