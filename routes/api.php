<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::name('login_with_token')->post('/loginWithToken', [AuthController::class, 'loginWithToken']);
        Route::name('logout')->get('/logout', [AuthController::class, 'logout']);
    });
});


Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::name('login')->post('/login', [AuthController::class, 'login']);
    Route::name('create')->post('/create', [AuthController::class, 'create']);
    Route::name('update')->match(['PUT', 'PATCH'], '/update/{user}', [AuthController::class, 'update']);
    Route::name('delete')->delete('/delete/{user}', [AuthController::class, 'delete']);
});