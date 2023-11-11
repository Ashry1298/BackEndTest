<?php

namespace App\Http\Requests\payments;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecordPayment extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transaction_created_at = Transaction::find($this->transaction_id)->value('created_at');
        $transaction_created_at = Carbon::parse($transaction_created_at)->format('Y-m-d H:i:s');
        return [
            'transaction_id' => [
                'required',
                'numeric',
                Rule::exists('transactions', 'id')->where(function ($query) {
                    $query->where('customer_id', auth()->id());
                }),
            ],
            'amount' => 'required|numeric',
            'paid_on' => 'required|date|after_or_equal:' . $transaction_created_at,
            'details' => 'nullable',
        ];
    }
}
