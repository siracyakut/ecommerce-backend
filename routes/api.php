<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\TicketController;
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

Route::prefix('charge')->group(function () {
    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get('history', [ChargeController::class, 'get_history']);
        Route::post('add-credit', [ChargeController::class, 'add_credit']);
    });
});

Route::prefix('ticket')->group(function () {
    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::prefix('get')->group(function () {
            Route::get('', [TicketController::class, 'get_tickets']);
            Route::get('{id}', [TicketController::class, 'get_ticket']);
        });
        Route::post('create', [TicketController::class, 'create_ticket']);
        Route::put('update', [TicketController::class, 'edit_ticket']);
        Route::post('create-message', [TicketController::class, 'add_ticket_message']);
    });
});
