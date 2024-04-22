<?php

use App\Http\Controllers\CustomersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/customer'], function () {
    Route::post('/create-customer', [
        CustomersController::class,
        'createCustomer',
    ]);

    Route::get('/get-customers', [
        CustomersController::class,
        'getCustomers',
    ]);

    Route::delete('/delete-customer', [
        CustomersController::class,
        'deleteCustomer',
    ]);
    
});
