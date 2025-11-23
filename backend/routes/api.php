<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return auth()->user();
    });
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::middleware('auth:sanctum')->prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index']);
    Route::get('/granted', [FileController::class, 'index_files_granted']);

    Route::group(['middleware' => 'can:owner,file'], function () {
        Route::delete('/{file}', [FileController::class, 'destroy']);
        Route::patch('/{file}', [FileController::class, 'update']);
        Route::get('/{file}/granted-users', [FileController::class, 'index_users_granted']);
        Route::post('/{file}/permissions/{user}', [FileController::class, 'give_permission']);
        Route::delete('/{file}/permissions/{user}', [FileController::class, 'revoke_permission']);
    });

    Route::group(['middleware' => 'can:granted,file'], function () {
        Route::get('/{file}', [FileController::class, 'show']);
    });

    Route::post('/', [FileController::class, 'store']);
});
