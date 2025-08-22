<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login' , [AuthController::class, 'login']);
Route::post('/create-user', [UserController::class, 'createUser']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
