<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SanctumAuthController;
use App\Http\Controllers\API\JobController;

Route::controller(SanctumAuthController::class)->group(function () {
    Route::post('/users/register', 'register')->name('users.register');
    Route::post('/users/login', 'login')->name('users.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('jobs', JobController::class);
    Route::post('/users/logout', [SanctumAuthController::class, 'logout'])->name('users.logout');
});
