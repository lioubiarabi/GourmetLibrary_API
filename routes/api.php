<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BookController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\CategoryController;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
Route::apiResource('books', BookController::class)->middleware('auth:sanctum');
Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');
