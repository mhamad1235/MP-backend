<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\TwilioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Auth\Events\Verified;

Route::group(["prefix" => "auth"], function () {
    Route::get('/{provider}', [SocialAuthController::class, 'redirectToProvider']);
    Route::get('/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
    // Route::post('/send', [TwilioController::class, 'sendOtp']);
    // Route::post('/verify', [TwilioController::class, 'verify']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login'])->name('login');
});

Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
    ->name('verification.send');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])
    ->name('verification.verify');


    Route::middleware('auth:sanctum')->group(function () {

    });
