<?php

use App\Http\Controllers\Tenants\Admin\RolesController;
use App\Http\Controllers\Tenants\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->get('/', [\App\Http\Controllers\Tenants\DashboardController::class, 'index'])->name('dashboard');
Route::group(['middleware' => 'auth'], function() {
    Route::put('users/permissions/{user}', [UsersController::class, 'updatePermissions'])->name('user.update.permissions');
    Route::resource('roles', RolesController::class)->middleware('permission:access user management');
    Route::resource('users', UsersController::class)->middleware('can:access user management');

});

Route::get('/test',function(){
    dd(auth()->user()->hasPermission('access medical'));
});

