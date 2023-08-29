<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminTimeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\Admin\AdminBookingController;

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

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('time', AdminTimeController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::resource('room', AdminRoomController::class)->except(['create', 'edit']);
        Route::resource('user', AdminUserController::class)->except(['create', 'edit']);
        Route::get("bookingRequest", [AdminBookingController::class, 'bookingRequest']);
        Route::patch("bookingRequest/approve/{booking}", [AdminBookingController::class, 'approve']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('room', [UserRoomController::class, 'index']);
        Route::get('booking/room/{room}', [UserBookingController::class, 'index']);
        Route::post('booking', [UserBookingController::class, 'store']);
        Route::get('myBooking', [UserBookingController::class, 'myBooking']);
        Route::delete('booking/{booking}', [UserBookingController::class, 'destroy']);
    });
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('admin/login', 'adminLogin');
    Route::get('logout', 'logout')->middleware(['auth:sanctum']);
});
