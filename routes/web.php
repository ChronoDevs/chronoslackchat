<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WEB\TopController;
use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\HomeController;
use App\Http\Controllers\WEB\RoleController;
use App\Http\Controllers\WEB\ChannelController;
use App\Http\Controllers\WEB\ChannelMemberController;
use App\Http\Controllers\WEB\MessageController;
use App\Events\MessageSent;

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

// Route::get('/', [TopController::class, 'index'])->name('web.top');

// Route::group(['as' => 'web.auth.'], function () {
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::get('/register', [AuthController::class, 'register'])->name('register');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('web.home');

// // Channels
// Route::get('/channel', [ChannelController::class, 'create'])->name('web.channel');

Route::group(['as' => 'web.auth.'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['as' => 'web.'], function () {
        // Channels
        Route::resource('/channels', ChannelController::class);
        Route::post('add/{user}/to/{channel}', [ChannelController::class, 'addMember'])->name('add.member');
        Route::delete('remove/{user}/to/{channel}', [ChannelController::class, 'removeMember'])->name('remove.member');

        // Channel Members
        Route::resource('/channel/members', ChannelMemberController::class);

        // Messages
        Route::get('/messages/{channel}', [MessageController::class, 'fetchMessages'])->name('fetch.messages');
        Route::post('/messages/{channel}', [MessageController::class, 'fetchMessages'])->name('fetch.messages');
        Route::post('/messages/{channel}', [MessageController::class, 'sendMessage'])->name('send.message');

    });

    // Add User
    Route::resource('/users', AuthController::class)->middleware('is_admin');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});