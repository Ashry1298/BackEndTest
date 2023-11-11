<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\TransactionStatus;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\reports\BasicReportRequest;
use App\Http\Requests\reports\MonthlyReportRequest;
use App\Http\Resources\TransactionBasicReportResource;
use App\Http\Resources\TransactionMonthlyReportResource;
use App\Http\Resources\TransactionReportsResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionReportsController extends Controller
{
    use ResponseTrait;
    public function getBasicReport(BasicReportRequest $request)
    {
        $startDate = Carbon::parse($request->starting_date)->startOfDay();
        $endDate = Carbon::parse($request->ending_date)->endOfDay();


        $reportData = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        return $this->successData(TransactionBasicReportResource::collection($reportData));
    }


    public function getMonthlyReport(MonthlyReportRequest $request)
    {

        $startDate = Carbon::parse($request->starting_date)->startOfDay();
        $endDate = Carbon::parse($request->ending_date)->endOfDay();

        //where due on ,groupBy month ,year


        $reportData = Transaction::select(
            DB::raw('MONTH(due_on) as month'),
            DB::raw('YEAR(due_on) as year'),
            DB::raw('SUM(CASE WHEN status = "' . TransactionStatus::PAID . '" THEN amount END) as paid'),
            DB::raw('SUM(CASE WHEN status = "' . TransactionStatus::OUTSTANDING . '" THEN amount END) as outstanding'),
            DB::raw('SUM(CASE WHEN status = "' . TransactionStatus::OVERDUE . '" THEN amount END) as overdue')
        )
            ->whereBetween('due_on', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(due_on)'), DB::raw('MONTH(due_on)'))
            ->get();

        return $this->successData(TransactionMonthlyReportResource::collection($reportData));
    }
}
