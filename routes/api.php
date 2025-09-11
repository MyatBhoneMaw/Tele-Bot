<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/create-user', [UserController::class, 'createUser']);
    Route::get('/users', [UserController::class, 'packageBuyUser']);
    Route::get('/employee', [UserController::class, 'getEmployee']);
    Route::get('/employee/{id}', [UserController::class, 'show']);
    Route::post('/delete', [UserController::class, 'delete']);
});
