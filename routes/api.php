<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'v1'], function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [AuthController::class, 'login']);
    
        Route::group([
            'middleware' => 'api'
        ], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('me', [AuthController::class, 'me']);
        });
    });
});
