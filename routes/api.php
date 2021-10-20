<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('v1/users', App\Http\Controllers\UserController::class)->middleware('auth.token');
Route::post('v1/auth', [\App\Http\Controllers\UserController::class, 'auth'])->middleware('auth.token');
Route::apiResource('v1/tasks', App\Http\Controllers\TaskController::class)->middleware('auth.token');
Route::post('v1/auth/tasks', [\App\Http\Controllers\TaskController::class, 'auth'])->middleware('auth.token');
