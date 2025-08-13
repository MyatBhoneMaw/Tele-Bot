<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/message', function() {
    return 'hello';
});

Route::get('/send-message', [TelegramController::class, 'sendMessage']);
Route::get('/replay' , [TelegramController::class, 'checkReply']);