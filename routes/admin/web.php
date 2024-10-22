<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
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
     //'auth',
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

                Route::get('dashboard', function () {
                    
                    return view('admin.dashboard.index');
                })->name('dashboard');

            });
    });
    // Auth::routes();

    Route::get('/dashboard', [App\Http\Controllers\Admin\dashboardController::class, 'index'])->name('dashboard');
