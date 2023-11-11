<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\TransactionPaymentsResource;
use App\Models\Payment;
use App\Models\Transaction;
use App\Traits\ResponseTrait;

class CustomerController
{
    use ResponseTrait;

    public function getTransactionPayments($transactionId)
    {

        $transaction = Transaction::where('id', $transactionId)
            ->where('customer_id', auth()->id())
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found or does not belong to the user'], 404);
        }


        return $this->successData(TransactionPaymentsResource::collection($transaction->payments));
    }



}
