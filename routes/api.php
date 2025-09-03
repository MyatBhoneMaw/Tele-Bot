<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post('/create-user', [UserController::class, 'createUser']);
Route::get('/users', [UserController::class, 'packageBuyUser']);
Route::get('/employee', [UserController::class, 'getEmployee']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
