<?php

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


Route::get('/index2', function () {
    return view('products_list2');
});

// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {


    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', function () {
        return view('dashboard'); 
    })->name('home');

    // Route::get('/users/datatable', [App\Http\Controllers\UserManagement\UserController::class, 'anyData'])->name('show.user-datatable');
    // Route::get('/roles/list', [App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'list'])->name('list.role');
    // Route::post('/users/user-role', [App\Http\Controllers\UserManagement\UserController::class, 'giveRoleToUser'])->name('store.user-role');
    // Route::delete('/users/delete/{id}', [App\Http\Controllers\UserManagement\UserController::class, 'destroy'])->name('destroy.user');
    // Route::delete('/users/update/{id}', [App\Http\Controllers\UserManagement\UserController::class, 'update'])->name('update.user');
    // Route::get('/users/get/{id}', [App\Http\Controllers\UserManagement\UserController::class, 'update'])->name('get.user');

    // Route::group(['prefix' => 'roles'], function () {
    //     Route::get('/datatable',[App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'anyData'])->name('show.role-datatable');
    // });


    // Route::group(['prefix' => 'permission','middleware' => ['auth']], function () {
    //     Route::get('/', function () {
    //         return view('adminlte::permissions');
    //     })->name('permissions');
    //     Route::get('/datatable',[App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'anyDataPermission'])->name('permissions.datatable');
    //     Route::get('/select2', [App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'getPermission'])->name('list.permission');
    //     Route::get('/role/datatable', [App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'getPermissionByRole'])->name('list.permissions-by-role');
    //     Route::post('/role', [App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'givePermissionToRole'])->name('store.permission-role');
    //     Route::put('/revoke/{id}', [App\Http\Controllers\UserManagement\RoleAndPermissionController::class, 'revokePermissionFromRole'])->name('revoke.permission');
    // });

    // Route::group(['prefix' => 'application',], function () {
    //     Route::get('/', function () {
    //         return view('applications');
    //     })->name('applications');
    //     Route::get('/datatable',[App\Http\Controllers\ApplicationController::class, 'anyData'])->name('application.datatable');
    // });

    // Route::group(['prefix' => 'company',], function () {
    //     Route::get('/', function () {
    //         return view('company');
    //     })->name('company');
    //     Route::get('/datatable',[App\Http\Controllers\ApplicationController::class, 'anyData'])->name('company.datatable');
    // });


    // //custom_edition
    // Route::group(['prefix' => 'markets',], function () {
    //     Route::get('/', function () {
    //         return view('custom_edition.markets');
    //     })->name('market');
    // });

});
