<?php

use App\Http\Controllers\Api\V1\AuthTokenController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::get('/lessons', [LessonController::class, 'index']);
    Route::get('/lessons/{lesson}', [LessonController::class, 'show']);

    Route::post('/auth/token', [AuthTokenController::class, 'issue']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/bookings', [BookingController::class, 'index']);
    });
});