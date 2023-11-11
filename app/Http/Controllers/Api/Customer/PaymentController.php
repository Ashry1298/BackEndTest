<?php

namespace App\Http\Controllers\Api\Customer;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use PhpParser\Node\Stmt\Else_;
use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\payments\RecordPayment;

class PaymentController extends Controller
{
    use ResponseTrait;
    public function recordPayment(RecordPayment $request)
    {
        $data = $request->validated();
        $paidOn = Carbon::parse($request->paid_on);
        $transaction = Transaction::findOrFail($request->transaction_id);


        if ($request->amount == $transaction->amount) {
            $status = TransactionStatus::PAID;
        } else {
            $status = $paidOn->gte($transaction->due_on) ? TransactionStatus::OVERDUE : TransactionStatus::OUTSTANDING;
        }
        $data['status'] = $status;

        //record payment 

        $payment = Payment::create($data);

        // update status and payment amount in Transaction

        $transaction->update([
            'status' => $status,
            'amount_paid' => $request->amount,
        ]);

        return $this->successMsg('payment recorded successfully');
    }
}
