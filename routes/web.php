<?php

use App\Http\Controllers\LuckyPageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('web.register');
});

Route::get('/register', function () {
    return Inertia::render('Register');
})->name('web.register');


Route::get('/lucky-page/{token}', LuckyPageController::class)
    ->name('web.lucky.page')
    ->middleware('auth:sanctum');
