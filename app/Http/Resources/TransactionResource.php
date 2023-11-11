<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'main_category' =>  $this->category->name ,
            'sub_categories' => $this->subCategory->name,
            'amount' => $this->amount,
            'customer' => $this->customer->name,
            'due_on' => $this->due_on,
            'vat' => $this->vat,
            'is_vat_inclusive' => $this->is_vat_inclusive,
        ];
    }
}
