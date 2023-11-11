<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\TransactionController;
use App\Http\Controllers\Api\Admin\TransactionReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Customer\PaymentController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Admin Routes 


Route::prefix('admin')->group(function () {
    Route::post('sign-up', [AuthController::class, 'register']);
    Route::post('sign-in', [AuthController::class, 'login']);
});



Route::group(['middleware' => ['auth:sanctum', 'IsApiAdmin']], function () {

    Route::delete('admin/sign-out', [AuthController::class, 'logout']);


    //define categories routes 
    Route::prefix('categories')->group(function () {

        Route::controller(CategoryController::class)->group(function () {

            Route::get('/', 'index');
            Route::get('/{category}', 'show');
            Route::post('/store', 'store');
            Route::put('/{category}', 'update');
            Route::delete('/{category}', 'destroy');
        });
    });

    //define transactions routes

    Route::prefix('transactions')->group(function () {

        Route::controller(TransactionController::class)->group(function () {

            Route::get('/', 'index');
            Route::get('/{transaction}', 'show');
            Route::post('/store', 'store');
            Route::put('/{transaction}', 'update');
        });
    });


    Route::post('basic-report', [TransactionReportsController::class, 'getBasicReport']);

    Route::post('monthly-report', [TransactionReportsController::class, 'getMonthlyReport']);
});






//Customer Routes

Route::group(['middleware' => ['guest:sanctum']], function () {
    Route::prefix('customer')->group(function () {
        Route::post('sign-up', [CustomerAuthController::class, 'register']);
        Route::post('sign-in', [CustomerAuthController::class, 'login']);
    });
});



Route::group(['middleware' => ['auth:sanctum', 'IsApiCustomer']], function () {

    Route::delete('customer/sign-out', [CustomerAuthController::class, 'logout']);


    //record payment

    Route::post('payments/record-payment', [PaymentController::class, 'recordPayment']);


    //view transaction payments

    Route::get('/view-transaction-payments/{transaction}', [CustomerController::class, 'getTransactionPayments']);
});
