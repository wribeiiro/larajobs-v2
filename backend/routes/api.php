<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VacancyJobController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/users/register', 'register')->name('users.register');
    Route::post('/users/login', 'login')->name('users.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('jobs', VacancyJobController::class);
    Route::post('/users/logout', [AuthController::class, 'logout'])->name('users.logout');
    Route::get('/users/me', [AuthController::class, 'me'])->name('users.me');
});
