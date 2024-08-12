<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;


Route::apiResource('rooms', RoomController::class);

Route::post('rooms/{room}/reserve', [ReservationController::class, 'reserve']);
Route::post('rooms/{room}/release', [ReservationController::class, 'release']);
Route::get('rooms/{room}/statuses', [RoomController::class, 'statuses']);
