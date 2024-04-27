<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FeedbacksController;
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
    Route::get('/get-customers', [
        CustomersController::class,
        'getCustomers',
    ]);

    Route::post('/create-customer', [
        CustomersController::class,
        'createCustomer',
    ]);

    Route::put('/update-customer', [
        CustomersController::class,
        'updateCustomer',
    ]);

    Route::delete('/delete-customer', [
        CustomersController::class,
        'deleteCustomer',
    ]);
});

Route::group(['prefix' => '/feedback'], function () {
    Route::get('/get-feedbacks', [
        FeedbacksController::class,
        'getFeedbacks',
    ]);
    
    Route::post('/create-feedback', [
        FeedbacksController::class,
        'createFeedback',
    ]);
});
