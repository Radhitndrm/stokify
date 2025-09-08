<?php

use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UnitController;
use App\Http\Controllers\Apps\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apps\SupplierController;

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

    Route::resource('units', UnitController::class)->except('show');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::get('/suppliers/{supplier}/get-orders', [SupplierController::class, 'getOrders'])->name('suppliers.get-orders');
    Route::resource('suppliers', SupplierController::class)->except(['show']);
});


require __DIR__ . '/auth.php';
