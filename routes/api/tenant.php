<?php

use App\Http\Controllers\API\V1\Tenant\AttemptController;
use App\Http\Controllers\API\V1\Tenant\Auth\LoginController;
use App\Http\Controllers\API\V1\Tenant\Auth\RegisterController;
use App\Http\Controllers\API\V1\Tenant\DashboardController;
use App\Http\Controllers\API\V1\Tenant\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;


Route::prefix('v1/tenant')->name('api.v1.')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'authenticate']);
        Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:sanctum']);
        Route::post('register', RegisterController::class);
    });

    Route::middleware(['auth:sanctum', InitializeTenancyByRequestData::class])->group(function () {
        Route::apiResource('quizzes', QuizController::class);
        Route::get('dashboard', DashboardController::class);

        Route::get('attempts', [AttemptController::class, 'index']);
        Route::post('attempts/export', [AttemptController::class, 'export']);
        Route::get('attempts/{attempt}', [AttemptController::class, 'show']);
    });
});
