<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::middleware('auth:sanctum')->prefix('files')->group(function () {
    Route::post('/', [FileController::class, 'index']);
    Route::post('/{file}', [FileController::class, 'show']);
    Route::delete('/{file}', [FileController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->prefix('file')->group(function () {
    Route::post('/', [FileController::class, 'store']);
});


