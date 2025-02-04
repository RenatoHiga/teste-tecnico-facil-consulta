<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Middleware\ValidateJWTToken;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

// Open endpoints
Route::group([], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::get('cidades', [ CityController::class, 'get' ]);
    
    Route::get('cidades/{id_city}/medicos', function (Request $request, string $id_city) {
        $doctorController = new DoctorController();
        return $doctorController->get($request, $id_city);
    });
    Route::get('medicos', [DoctorController::class, 'get']);
});

// Closed endpoints requiring JWT authentication.
Route::group([
    'middleware' => ['api', ValidateJWTToken::class]
], function () {
    Route::get('user', [AuthController::class, 'getMyUser']);

    Route::post('medicos', [DoctorController::class, 'create']);

    Route::get('medicos/{id_doctor}/pacientes', [PatientController::class, 'get']);
    Route::post('pacientes', [PatientController::class, 'create']);
    Route::post('pacientes/{id_patient}', [PatientController::class, 'update']);
});