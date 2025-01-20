<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateInquire;
use App\Http\Controllers\API\LogController;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\ValidateSendConfirm;
use App\Http\Middleware\ValidateSendValidate;
use App\Http\Middleware\ValidatePayoutConfirm;
use App\Http\Middleware\ValidatePayoutValidate;
use App\Http\Controllers\API\MaintenanceController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Middleware\CheckAdmin;

// Public Route
Route::post('login', [AuthController::class, 'login']);

// Private Routes
Route::middleware('auth:api')->group(function () {
    // Logout
    Route::get('logout', [AuthController::class, 'logout']);

    // Transaction routes
    Route::post('inquire', [TransactionController::class, 'inquire'])->middleware(ValidateInquire::class);
    Route::post('payout/validate', [TransactionController::class, 'payoutValidate'])->middleware(ValidatePayoutValidate::class);
    Route::post('payout/confirm', [TransactionController::class, 'payoutConfirm'])->middleware(ValidatePayoutConfirm::class);
    Route::post('send/validate', [TransactionController::class, 'sendValidate'])->middleware(ValidateSendValidate::class);
    Route::post('send/confirm', [TransactionController::class, 'sendConfirm'])->middleware(ValidateSendConfirm::class);
    Route::get('transactions', [TransactionController::class, 'getTransactions']);
    
    // Log route
    Route::get('logs', [LogController::class, 'getLogs']);

    // Maintenance routes (Admin Access Only)
    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('partners', [MaintenanceController::class, 'getPartners']);
        Route::get('purpose', [MaintenanceController::class, 'getPurpose']);
        Route::get('occupations', [MaintenanceController::class, 'getOccupations']);
        Route::get('employment', [MaintenanceController::class, 'getEmployment']);
        Route::get('sourcefund', [MaintenanceController::class, 'getSourceOfFund']);
        Route::get('relationship', [MaintenanceController::class, 'getRelationship']);
    });
});