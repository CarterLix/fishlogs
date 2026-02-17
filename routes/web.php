<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishlogsController;

Route::resource('fishlogs', FishlogsController::class) ->parameters(['fishlogs' => 'fishlogs']);

Route::get('/', function () {
    return view('home');
});

