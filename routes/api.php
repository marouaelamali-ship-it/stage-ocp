<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\MaintenanceController;

/*
|--------------------------
| Public routes
|--------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/maintenances', [MaintenanceController::class, 'index']);

/*
|--------------------------
| Protected routes (login required)
|--------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('equipments', EquipmentController::class);
    Route::apiResource('maintenances', MaintenanceController::class);

});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});