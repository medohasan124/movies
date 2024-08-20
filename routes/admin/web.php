<?php

use App\Http\Controllers\Admin\permissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
     'auth',
    // 'role:SuperAdmin|Admin'
])
    ->prefix(LaravelLocalization::setLocale())
    ->group(function () {
        Route::name('admin.')
            ->prefix('admin')
            ->group(function () {

                Route::get('role',[RoleController::class,'index'])->name('role.index');
                Route::post('role/bulckDelete',[RoleController::class,'bulckDelete'])->name('role.bulckDelete');
                Route::get('role/data',[RoleController::class,'data'])->name('role.data');
                Route::resource('roles',RoleController::class)->names('roles');

                Route::get('permission',[permissionController::class,'index'])->name('permission.index');
                Route::get('permission/data',[permissionController::class,'data'])->name('permission.data');


              //  Route::get('User',[UserController::class,'index'])->name('User.index');
                Route::post('User/bulckDelete',[UserController::class,'bulckDelete'])->name('User.bulckDelete');
                Route::get('User/data',[UserController::class,'data'])->name('User.data');
                Route::resource('User',UserController::class)->names('User');

                Route::get('dashboard', function () {
                    return view('admin.dashboard.index');
                })->name('dashboard');

            });
    });
     Auth::routes();

    Route::get('/dashboard', [App\Http\Controllers\Admin\dashboardController::class, 'index'])->name('dashboard');
