<?php

use Illuminate\Support\Facades\Route;



Route::get('/{any}', function () {
    return view('app'); // Vue SPA Shell
})->where('any', '.*');