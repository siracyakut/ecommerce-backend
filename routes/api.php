<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::middleware([GuestMiddleware::class])->group(function () {
        Route::post('login', [UserController::class, 'login']);
        Route::post('register', [UserController::class, 'register']);
    });

    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get('check', [UserController::class, 'check']);
        Route::put('update', [UserController::class, 'update']);
        Route::get('logout', [UserController::class, 'logout']);
    });
});
