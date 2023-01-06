<?php

use App\Http\Controllers\Api\v1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\v1\Auth\NewPasswordController;
use App\Http\Controllers\Api\v1\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\v1\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Api\v1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\v1\Auth\PasswordController;
use App\Http\Controllers\Api\v1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\v1\Auth\VerifyEmailController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['permission:' . User::PERMISSION_CREATE_DELETE_USERS]], function () {
        Route::post('register', [RegisteredUserController::class, 'store']);
    });

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
