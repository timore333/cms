<?php

use App\Http\Controllers\Tenants\Admin\RolesController;
use App\Http\Controllers\Tenants\Admin\UsersController;
use App\Http\Controllers\Tenants\Client\Patient\PatientsController;
use App\Http\Controllers\Tenants\General\SettingController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->get('/', [\App\Http\Controllers\Tenants\DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::put('users/permissions/{user}', [UsersController::class, 'updatePermissions'])->name('user.update.permissions');
    Route::resource('roles', RolesController::class)->middleware('permission:access user management');
    Route::resource('users', UsersController::class)->middleware('can:access user management');
    Route::resource('patients', PatientsController::class)->middleware('can:access user management');
    Route::resource('drugs', \App\Http\Controllers\Tenants\Medical\DrugsController::class);
    Route::resource('companies', \App\Http\Controllers\Tenants\Client\Insurance\CompanyController::class);
    Route::resource('procedures', \App\Http\Controllers\Tenants\Operation\ProceduresController::class);
    Route::resource('labs', \App\Http\Controllers\Tenants\Supplier\Lab\LabsController::class);

    Route::resource('/setting', SettingController::class);
    Route::get('calendar', [\App\Http\Controllers\Tenants\General\CalendarController::class, 'calendar'])->name('calendar');
    Route::post('calendar', [\App\Http\Controllers\Tenants\General\CalendarController::class, 'store'])->name('appointment.store');
    Route::put('calendar/{id}', [\App\Http\Controllers\Tenants\General\CalendarController::class, 'update'])->name('appointment.update');
    Route::delete('calendar/{id}', [\App\Http\Controllers\Tenants\General\CalendarController::class, 'destroy'])->name('appointment.delete');

});

Route::get('/test', function() {
    //Setting::create(['name'=>'locale', 'value'=>'en']);
});

