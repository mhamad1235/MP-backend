<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\TwilioController;
use App\Http\Controllers\Auth\LoginController;

Route::group(["prefix" => "auth"], function () {
    Route::get('/{provider}', [SocialAuthController::class, 'redirectToProvider']);
    Route::get('/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
    Route::post('/send', [TwilioController::class, 'sendOtp']);
    Route::post('/verify', [TwilioController::class, 'verify']);
    Route::post('/login',[LoginController::class,'login']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});
