<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('rooms', RoomController::class);
    Route::post('rooms/{room}/reserve', [ReservationController::class, 'reserve']);
    Route::post('rooms/{room}/release', [ReservationController::class, 'release']);
    Route::get('rooms/{room}/statuses', [RoomController::class, 'statuses']);
});

