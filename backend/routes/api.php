<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VacancyJobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/users/register', 'register')->name('users.register');
    Route::post('/users/login', 'login')->name('users.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('jobs', VacancyJobController::class);
    Route::post('/users/logout', [AuthController::class, 'logout'])->name('users.logout');
    Route::get('/users/me', [AuthController::class, 'me'])->name('users.me');
});
