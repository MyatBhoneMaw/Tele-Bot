<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;


Route::get('/{any}', function () {
    return view('app'); // Vue SPA Shell
})->where('any', '.*');