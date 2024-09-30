<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\LuckyController;
use App\Http\Controllers\Api\UserRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', UserRegisterController::class)->name('api.user.register');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/imfeelinglucky', [LuckyController::class, 'store'])->name('api.lucky.tryLuck');
    Route::get('/imfeelinglucky', [LuckyController::class, 'history'])->name('api.lucky.history');

    Route::delete('/lucky-page-tokens/{token}', [AccessTokenController::class, 'destroy'])->name('api.lucky-page-token.destroy');
    Route::post('/lucky-page-tokens', [AccessTokenController::class, 'store'])->name('api.lucky-page-token.create');
});
