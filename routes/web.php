<?php

use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check())
        return to_route('apps.dashboard');
    return inertia('auth/login');
});


Route::group(['prefix' => 'apps', 'as' => 'apps.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('permissions', PermissionController::class)->except(['create', 'edit', 'show']);

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('users', UserController::class);
});


require __DIR__ . '/auth.php';
