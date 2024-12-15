<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\AccountController;
use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\TransactionController;

/* Start of Auth Routes */

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/* End of Auth Routes */

/* Start of Countries Routes */

Route::apiResource('countries', CountryController::class);
/* End of Countries Routes */

/* Start of Cities Routes */
Route::apiResource('cities', CityController::class);
/* End of Cities Routes */


/* Protected Routes */
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile-update', [AuthController::class, 'updateProfile']);
    Route::put('/password-update', [AuthController::class, 'updatePassword']);

    /* Start of Accounts Routes */
    Route::prefix('accounts')->group(function () {
        Route::get('/', [AccountController::class, 'index']);
        Route::post('/', [AccountController::class, 'store']);
        Route::get('/{account}', [AccountController::class, 'show']);
        Route::get('/{account}/balance', [AccountController::class, 'getBalance']);
    });
    /* End of Accounts Routes */

    /* Start of Transactions Routes */
    Route::prefix('accounts/{account}/transactions')->group(function () {
        Route::post('/deposit', [TransactionController::class, 'deposit']);
        Route::post('/withdraw', [TransactionController::class, 'withdraw']);
        Route::post('/transfer', [TransactionController::class, 'transfer']);
        Route::get('/history', [TransactionController::class, 'history']);
    });
    /* End of Transactions Routes */

    /* Start of Settings Routes */
    Route::get('/settings', [SettingController::class, 'index']);
    /* End of Settings Routes */

    /* Start of Addresses Routes */
    Route::apiResource('addresses', AddressController::class);
    /* End of Addresses Routes */
});
