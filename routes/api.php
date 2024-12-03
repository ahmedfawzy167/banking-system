<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TransactionController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
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
});
