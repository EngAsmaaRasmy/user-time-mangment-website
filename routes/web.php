<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PharmaciesController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TimesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');
Route::get('/home', function () {
    $routeName = auth()->user() && (auth()->user()->is_user) ? 'admin.calendar.index' : 'admin.home';
    if (session('status')) {
        return redirect()->route($routeName)->with('status', session('status'));
    }

    return redirect()->route($routeName);
});

Auth::routes(['register' => false]);

// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // RangeTimes
    Route::delete('times/destroy', [TimesController::class, 'massDestroy'])->name('times.massDestroy');
    Route::resource('times', TimesController::class);

    // Pharmacies
    Route::delete('pharmacies/destroy', [PharmaciesController::class, 'massDestroy'])->name('pharmacies.massDestroy');
    Route::resource('pharmacies', PharmaciesController::class);

    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('search', [CalendarController::class, 'search'])->name('calendar.search');
});