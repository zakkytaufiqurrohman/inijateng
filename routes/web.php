<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginCustomeController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\PermissionController;

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

Auth::routes();

Route::get('/login', [LoginCustomeController::class,'index'])->name('login');
Route::post('/login', [LoginCustomeController::class,'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //logout
    Route::post('/logout', [LoginCustomeController::class,'logout'])->name('logout');

    // role
    Route::name('role')->prefix('roles')->group(function(){
        Route::get('/', [RoleController::class,'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::delete('/', [RoleController::class, 'destroy']);
        Route::put('/', [RoleController::class, 'update']);
        Route::get('/data', [RoleController::class,'data'])->name('.data');
        Route::get('/getPermission', [RoleController::class,'getPermission'])->name('.getPermission');
        Route::get('/show', [RoleController::class,'show'])->name('.show');

    
    });
    //permission
    Route::name('permission')->prefix('/permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('.index');
        Route::post('/', [PermissionController::class, 'store']);
        Route::put('/', [PermissionController::class, 'update']);
        Route::get('/data', [PermissionController::class, 'data'])->name('.data');
        Route::delete('/', [PermissionController::class, 'destroy'])->name('.delete');
        Route::get('/show', [PermissionController::class,'show'])->name('.show');
    });

});

Route::view('/table', 'components.table');
Route::view('/form', 'components.form');
Route::view('/register', 'components.register');
