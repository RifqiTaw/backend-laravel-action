<?php

use App\Actions\Auth\ConfirmPassword;
use App\Actions\Auth\EmailVerificationPrompt;
use App\Actions\Auth\ForgotPassword;
use App\Actions\Auth\LoginUser;
use App\Actions\Auth\LogoutUser;
use App\Actions\Auth\RegisterUser;
use App\Actions\Auth\ResetPassword;
use App\Actions\Auth\SendEmailVerificationNotification;
use App\Actions\Auth\UpdatePassword;
use App\Actions\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('register', RegisterUser::class);

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('login', LoginUser::class);

    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('forgot-password', ForgotPassword::class)->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', ResetPassword::class)->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPrompt::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmail::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', SendEmailVerificationNotification::class)
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', function () {
        return view('auth.confirm-password');
    })->name('password.confirm');

    Route::post('confirm-password', ConfirmPassword::class);

    Route::put('password', UpdatePassword::class)->name('password.update');

    Route::post('logout', LogoutUser::class)->name('logout');
});
