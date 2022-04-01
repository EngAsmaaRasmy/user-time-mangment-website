<?php

use App\Http\Controllers\Api\V1\Admin\PermissionsApiController;
use App\Http\Controllers\Api\V1\Admin\PharmaciesApiController;
use App\Http\Controllers\Api\V1\Admin\RolesApiController;
use App\Http\Controllers\Api\V1\Admin\TimesApiController;
use App\Http\Controllers\Api\V1\Admin\UsersApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionsApiController::class);

    // Roles
    Route::apiResource('roles', RolesApiController::class);

    // Users
    Route::apiResource('users', UsersApiController::class);

    // Times
    Route::apiResource('times', TimesApiController::class);

    // Pharmacies
    Route::apiResource('pharmacies', PharmaciesApiController::class);
});
