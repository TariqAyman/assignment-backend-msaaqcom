<?php

use App\Http\Controllers\API\V1\Tenant\Auth\LoginController;
use App\Http\Controllers\API\V1\Tenant\Auth\RegisterController;
use App\Http\Controllers\API\V1\Tenant\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

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

require __DIR__.'/tenant.php';
require __DIR__.'/member.php';
