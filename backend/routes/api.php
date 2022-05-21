<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     clock($request->user());
//     return new UserResource($request->user());
// });

Route::middleware('auth:sanctum')->group(function() {
    Route::get('room/{user}', [RoomController::class, 'index']);
    Route::post('room/{user}', [RoomController::class, 'store']);
    Route::get('room', [RoomController::class, 'show']);
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
});

Route::post('member', [MemberController::class, 'store']);

Route::prefix('admin', function () {
    Route::post('login', [AuthController::class, 'login']);
});
