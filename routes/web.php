<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WEB\TopController;
use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\HomeController;

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

Route::get('/', [TopController::class, 'index'])->name('web.top');

Route::group(['as' => 'web.auth.'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('web.home');