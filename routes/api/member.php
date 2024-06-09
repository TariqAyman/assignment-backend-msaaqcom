<?php

use App\Http\Controllers\API\V1\Member\AnswerQuestionController;
use App\Http\Controllers\API\V1\Member\Auth\ListTenantsController;
use App\Http\Controllers\API\V1\Member\Auth\LoginController;
use App\Http\Controllers\API\V1\Member\Auth\RegisterController;
use App\Http\Controllers\API\V1\Member\DashboardController;
use App\Http\Controllers\API\V1\Member\QuizController;
use App\Http\Controllers\API\V1\Member\QuizSubscribeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

Route::prefix('v1/member')->name('api.v1.')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('list-tenants', ListTenantsController::class);
        Route::post('login', [LoginController::class, 'authenticate']);
        Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:sanctum']);
        Route::post('register', RegisterController::class);
    });

    Route::middleware(['auth:sanctum', InitializeTenancyByRequestData::class])->group(function () {
        Route::post('quiz/subscribe', QuizSubscribeController::class);

        Route::apiResource('quizzes', QuizController::class)->only(['index', 'show']);
        Route::get('dashboard', DashboardController::class);

        Route::post('quiz/{id}/answer', AnswerQuestionController::class);
    });
});
