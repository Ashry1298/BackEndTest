<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\transactions\Store;
use App\Http\Requests\transactions\StoreTransactionRequest;
use App\Http\Requests\transactions\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $transactions = Transaction::get();
        return TransactionResource::collection($transactions);
    }

    public function store(StoreTransactionRequest $request)
    {
        //get the request validated
        $data = $request->validated();

        $currentDate = Carbon::now();

        if ($currentDate->gte($request->due_on)) {
            $status = TransactionStatus::OVERDUE;
        } else {
            $status = TransactionStatus::OUTSTANDING;
        }
        $data['status'] = $status;

        $transaction = Transaction::create($data);


        return new TransactionResource($transaction);
    }

    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }



   
}
