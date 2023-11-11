<?php

namespace App\Http\Controllers;

use App\Http\Requests\transactions\Store;
use App\Http\Requests\transactions\StoreTransactionRequest;
use App\Http\Requests\transactions\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::get();
        return TransactionResource::collection($transactions);
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        return new TransactionResource($transaction);
    }

    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    // public function update(UpdateTransactionRequest $request, Transaction $transaction)
    // {
    //     $transaction->update($request->all());
    //     return new TransactionResource($transaction);
    // }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }
}
