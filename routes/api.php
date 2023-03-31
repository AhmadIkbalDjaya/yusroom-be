<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::middleware(['auth:sanctum', 'admin'])->group(function () {
            Route::get('bookingRequest', "bookingRequest");
            Route::patch("approve/{booking}", "approve");
        });
    });
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('login', 'login');
    Route::get('logout', 'logout')->middleware(['auth:sanctum']);
});

Route::prefix('employee')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(RoomController::class)->group(function () {
            Route::get('room', 'index');
            Route::get('room/{room}', 'show');
        });
        Route::controller(BookingController::class)->group(function () {
            Route::post('booking', "store");
            Route::get('booking/{booking}', "show");
            Route::patch('booking/{booking}', "update");
            Route::delete("booking/{booking}", "destroy");
        });
    });
});


