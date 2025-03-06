<?php

use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TimesheetController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'loggedInUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/projects', ProjectController::class);
    Route::apiResource('/attributes', AttributeController::class);
    Route::apiResource('/timesheets', TimesheetController::class);
});
