<?php

use App\Http\Controllers\Tenants\Admin\RolesController;
use App\Http\Controllers\Tenants\Admin\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

    Route::put('users/permissions/{user}', [UsersController::class, 'updatePermissions'])->name('user.update.permissions');
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);

