<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WatchController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

Route::get('watches', [WatchController::class, 'getAll']);
Route::get('watches/{id}', [WatchController::class, 'get']);
Route::post('watches', [WatchController::class, 'create']);
Route::put('watches/{id}', [WatchController::class, 'update']);
Route::delete('watches/{id}', [WatchController::class, 'delete']);