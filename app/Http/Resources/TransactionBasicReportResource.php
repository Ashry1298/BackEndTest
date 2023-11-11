<?php

namespace App\Http\Resources;

use App\Enums\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionBasicReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'Period'=>$this->created_at,
            'Paid amount' => $this->sum('amount_paid'),
            'OutStanding Amount' => $this->where('status', TransactionStatus::OUTSTANDING)->sum('amount_paid'),
            'Overdue Amount' => $this->where('status', TransactionStatus::OVERDUE)->sum('amount_paid'),

        ];
    }
}
