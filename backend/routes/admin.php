<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('admin')->group(function (){
    Route::resource('room', RoomController::class)->only([
        'index',
        'show',
        'update',
        'destroy'
    ]);
    Route::resource('user', UserController::class)->only([
        'index',
        'show',
        'update',
        'destroy'
    ]);
});

Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout']);