<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;

Route::post('login', [AuthController::class, 'login']);

Route::get('cidades', [ CityController::class, 'get' ]);
Route::get('cidades/{id_city}/medicos', function (Request $request, string $id_city) {
    $doctorController = new DoctorController();
    return $doctorController->get($request, $id_city);
});
Route::get('medicos', [DoctorController::class, 'get']);

Route::group([
    'middleware' => 'api'
], function () {
    Route::get('user', [AuthController::class, 'getMyUser']);

    Route::post('medicos', [DoctorController::class, 'create']);

    
});