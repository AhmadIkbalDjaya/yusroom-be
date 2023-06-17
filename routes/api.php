<?php

use App\Http\Controllers\Admin\AdminRoonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\AdminTimeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\User\UserBookingController;

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
    Route::resource('time', AdminTimeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('room', AdminRoonController::class)->except(['create', 'edit']);
    Route::resource('user', AdminUserController::class)->except(['create', 'edit']);
    // Route::controller(AdminController::class)->group(function () {
    //     Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    //         Route::get('bookingRequest', "bookingRequest");
    //         Route::patch("approve/{booking}", "approve");
    //     });
    // });
});

Route::prefix('user')->group(function () {
    Route::get('room', [UserRoomController::class, 'index']);
    Route::get('booking/room/{room}', [UserBookingController::class, 'index']);
    Route::post('booking', [UserBookingController::class, 'store']);
    Route::get('myBooking', [UserBookingController::class, 'myBooking']);
    Route::delete('booking/{booking}', [UserBookingController::class, 'destroy']);
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
            Route::get('booking', 'index');
            Route::post('booking', "store");
            Route::get('booking/{booking}', "show");
            Route::patch('booking/{booking}', "update");
            Route::delete("booking/{booking}", "destroy");
        });
    });
});
