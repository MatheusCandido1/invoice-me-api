<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('sign-in', [AuthController::class, 'signIn']);
        Route::post('sign-up', [AuthController::class, 'signUp']);
        Route::post('sign-out', [AuthController::class, 'signOut']);
    });

    Route::group(['prefix' => 'companies'], function () {
        Route::post('', [CompanyController::class, 'store']);
        Route::get('/{company}', [CompanyController::class, 'show']);
        Route::put('/{company}', [CompanyController::class, 'update']);
        Route::delete('/{company}', [CompanyController::class, 'destroy']);
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('', [CustomerController::class, 'index']);
        Route::post('', [CustomerController::class, 'store']);
        Route::get('/{customer}', [CustomerController::class, 'show']);
        Route::put('/{customer}', [CustomerController::class, 'update']);
        Route::delete('/{customer}', [CustomerController::class, 'destroy']);
    });

    Route::group(['prefix' => 'accounts'], function () {
        Route::post('', [AccountController::class, 'store']);
        Route::get('', [AccountController::class, 'index']);
        Route::get('/{account}', [AccountController::class, 'show']);
        Route::put('/{account}', [AccountController::class, 'update']);
        Route::delete('/{account}', [AccountController::class, 'destroy']);
    });
});
