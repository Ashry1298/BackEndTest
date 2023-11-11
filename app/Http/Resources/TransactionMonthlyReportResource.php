<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionMonthlyReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "month" => $this->month,
            "year" => $this->year,
            "Paid" => $this->paid,
            "Outstanding" => $this->outstanding,
            "Overdue" => $this->overdue,
        ];
    }
}
