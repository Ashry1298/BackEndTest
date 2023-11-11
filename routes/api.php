<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\AuthController;
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
    Route::prefix('customer')->group(function () {
        Route::post('sign-up', [CustomerAuthController::class, 'register']);
        Route::post('sign-in', [CustomerAuthController::class, 'login']);
    });
  
});


Route::prefix('admin')->group(function () {
    Route::post('sign-up', [AuthController::class, 'register']);
    Route::post('sign-in', [AuthController::class, 'login']);
});

// add the two routes each one for it's middleware

// Route::middleware(['auth:sanctum', 'IsApiCustomer'])->delete('customer/sign-out', [CustomerAuthController::class, 'logout']);
// Route::middleware(['auth:sanctum', 'IsApiAdmin'])->delete('admin/sign-out', [AuthController::class, 'logout']);

// Route::group(['middleware' => ['auth:sanctum', 'IsApiAdmin']], function () {





//     //define categories routes 
//     Route::prefix('categories')->group(function () {

//         Route::controller(CategoryController::class)->group(function () {

//             Route::get('/', 'index');
//             Route::get('/{category}', 'show');
//             Route::post('/store', 'store');
//             Route::put('/{category}', 'update');
//             Route::delete('/{category}', 'destroy');
//             Route::post('/destroyAll', 'destroyAllCategories');
//         });
//     });

//     //define transactions routes

//     Route::prefix('transactions')->group(function () {

//         Route::controller(TransactionController::class)->group(function () {

//             Route::get('/', 'index');
//             Route::get('/{transaction}', 'show');
//             Route::post('/store', 'store');
//             Route::put('/{transaction}', 'update');
//         });
//     });
// });
