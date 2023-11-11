<?php

namespace App\Http\Resources;

use App\Enums\TransactionPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionPaymentsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Transaction ID' => $this->transaction_id,
            'Amount' => $this->amount,
            'Payment Method' => TransactionPaymentMethod::getNameByValue($this->transaction->payment_method),
            'Paid at' => $this->paid_on,
            'Details' => $this->details ?? 'No Details',
        ];
    }
}
