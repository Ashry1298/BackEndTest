<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\AuthController\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\TransactionController;
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


Route::group(['middleware' => ['guest:sanctum']], function () {
    Route::post('user/sign-up', [CustomerAuthController::class, 'register']);
    Route::post('user/sign-in', [CustomerAuthController::class, 'login']);
});


Route::prefix('admin')->group(function () {
    Route::post('sign-up', [AuthController::class, 'register']);
    Route::post('sign-in', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->post('logout', 'AuthController@logout');


Route::group(['middleware' => ['auth:sanctum', 'IsApiAdmin']], function () {

    //define categories routes 



    Route::controller(CategoryController::class)->group(function () {

        Route::get('categories',                'index');
        Route::get('categories/{category}',           'show');
        Route::post('categories/store',         'store');
        Route::put('categories/{category}',           'update');
        Route::delete('categories/{category}',        'destroy');
        Route::post('categories/destoryAll',    'destroyAllCategories');
    });




    //define transactions routes

    Route::controller(TransactionController::class)->group(function () {

        Route::get('transactions', 'index');
        Route::get('transactions/{transaction}', 'show');
        Route::post('transactions/store', 'store');
        Route::put('transactions/{transaction}', 'update');
    });
});
