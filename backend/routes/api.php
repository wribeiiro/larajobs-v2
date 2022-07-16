<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\JobController;

Route::post('/users/register', [PassportAuthController::class, 'register'])->name('users.register');
Route::post('/users/login', [PassportAuthController::class, 'login'])->name('users.login');
//Route::post('/logout', [PassportAuthController::class, 'logout'])->middleware('auth')->name('users.logout');

Route::middleware('auth:api')->group(function () {
    Route::resource('jobs', JobController::class);
});
