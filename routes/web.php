<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginCustomeController;
use App\Http\Controllers\Auth\RegisterCostumeController;
use App\Http\Controllers\Auth\DependentDropdownController;

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

Route::get('/register', [RegisterCostumeController::class,'index'])->name('register');
Route::post('/register', [RegisterCostumeController::class,'register'])->name('register');

// Laravolt/indonesia
Route::get('provinces', [DependentDropdownController::class,'provinces'])->name('provinces');
Route::get('cities', [DependentDropdownController::class,'cities'])->name('cities');
Route::get('districts', [DependentDropdownController::class,'districts'])->name('districts');
Route::get('villages', [DependentDropdownController::class,'villages'])->name('villages');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //logout
    Route::post('/logout', [LoginCustomeController::class,'logout'])->name('logout');

});