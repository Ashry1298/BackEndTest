<?php

namespace App\Http\Requests\reports;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyReportRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
        ];
    }
}
