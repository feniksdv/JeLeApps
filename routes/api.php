<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\User\ProfileController;

Route::prefix('v1')->group(function () {
    Route::post('registration', [RegistrationController::class, 'index']);
    Route::get('getProfile', [ProfileController::class, 'index']);
});
