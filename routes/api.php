<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('v1/users', App\Http\Controllers\UserController::class);
Route::post('v1/auth', [\App\Http\Controllers\UserController::class, 'auth']);
Route::apiResource('v1/tasks', App\Http\Controllers\TaskController::class);
