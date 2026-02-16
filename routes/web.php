<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishlogsController;

Route::get('/', [FishlogsController::class, 'index']);
