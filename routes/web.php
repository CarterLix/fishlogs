<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishlogsController;

Route::resource('fishlogs', FishlogsController::class) ->parameters(['fishlogs' => 'fishlogs']);

Route::get('/', function () {
    return view('home');
});


Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/dashboard', function () {
    return view('fishlog/index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('fishlogs', FishlogController::class);
});


