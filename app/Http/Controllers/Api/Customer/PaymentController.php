<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\payments\RecordPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function recordPayment(RecordPayment $request)
    {

        dd('here');
    }
}
