<?php

use Illuminate\Support\Facades\Route;
use Surge\Facades\Surge;

/*
|--------------------------------------------------------------------------
| Surge Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Surge dashboard routes.
|
*/

Route::get('/surge', function () {
    $status = Surge::status();
    return view('surge::dashboard', compact('status'));
})->name('surge.dashboard');
