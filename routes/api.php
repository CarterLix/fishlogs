<?php

use App\Http\Controllers\API\FishlogsController;
use App\Models\Fishlogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {
    
    Route::prefix('v1')->group(function() {
        Route::apiResource('/fishlogs', FishlogsController::class);
    });


    Route::prefix('v2')->group(function() {
        //future stuff
    });
});