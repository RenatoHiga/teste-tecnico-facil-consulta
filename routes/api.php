<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;

Route::post('login', [AuthController::class, 'login']);
Route::get('cidades', [ CityController::class, 'get' ]);

Route::group([
    'middleware' => 'api'
], function () {
    Route::get('user', [AuthController::class, 'getMyUser']);
});