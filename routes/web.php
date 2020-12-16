<?php

use App\Http\Controllers\Tenants\Admin\RolesController;
use App\Http\Controllers\Tenants\Admin\UsersController;
use App\Models\Tenants\Setting\Setting;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->get('/', [\App\Http\Controllers\Tenants\DashboardController::class, 'index'])->name('dashboard');
Route::group(['middleware' => 'auth'], function() {
    Route::put('users/permissions/{user}', [UsersController::class, 'updatePermissions'])->name('user.update.permissions');
    Route::resource('roles', RolesController::class)->middleware('permission:access user management');
    Route::resource('users', UsersController::class)->middleware('can:access user management');

});

Route::get('/test',function(){
//Setting::create(['name'=>'locale', 'value'=>'en']);
});

Route::resource('/setting',\App\Http\Controllers\Tenants\Setting\SettingController::class);