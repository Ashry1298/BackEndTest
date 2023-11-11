<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->name,
            'sub_categories' => $this->subcategories->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name'  => $item->name,
                ];
            }),
        ];
    }
}
