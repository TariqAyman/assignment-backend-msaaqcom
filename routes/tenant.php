<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Tenant\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function (Request $request) {
        $response = 'This is your multi-tenant application. The id of the current tenant is ' . tenant('name');

        if ($request->expectsJson() || $request->acceptsJson()) {
            $response = response()->json('This is your multi-tenant application. The id of the current tenant is ' . tenant('name'));
        }

        return $response;
    });
});
