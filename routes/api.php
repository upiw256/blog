<?php

use App\Http\Controllers\apiClassRoom;
use App\Http\Controllers\apiExtracurricular;
use App\Http\Controllers\ApiStudent;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Response;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'VerifyToken'], function () {
    Route::get('/students', [ApiStudent::class, 'index']);
    Route::get('/article', [ArticleController::class, 'index']);
    Route::get('/classroom', [apiClassRoom::class, 'index']);
    Route::get('/extracurricular', [apiExtracurricular::class, 'index']);
    Route::get('/extracurricular/{id}', [apiExtracurricular::class, 'show']);
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
    Route::get('/teacher/{id}', [ScheduleController::class, 'teacher']);

});

Route::fallback(function () {
    return response()->json(['error' => 'Page Not Found'], 404);
});
Route::middleware('VerifyToken')->get('/students', [ApiStudent::class, 'index']);
Route::middleware('VerifyToken')->get('/article', [ArticleController::class, 'index']);
Route::middleware('VerifyToken')->get('/classroom', [apiClassRoom::class, 'index']);
Route::middleware('VerifyToken')->get('/extracurricular', [apiExtracurricular::class, 'index']);
Route::middleware('VerifyToken')->get('/extracurricular/{id}', [apiExtracurricular::class, 'show']);
Route::middleware('VerifyToken')->get('/schedules', [ScheduleController::class, 'index']);
Route::middleware('VerifyToken')->get('/schedules/{id}', [ScheduleController::class, 'show']);
Route::middleware('VerifyToken')->get('/teachers', [TeachersController::class, 'index']);
Route::middleware('VerifyToken')->get('/teachers/{id}', [ScheduleController::class, 'teacher']);

