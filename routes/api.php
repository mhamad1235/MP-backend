<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\TwilioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
Route::group(["prefix" => "auth"], function () {
    Route::get('/{provider}', [SocialAuthController::class, 'redirectToProvider']);
    Route::get('/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
    // Route::post('/send', [TwilioController::class, 'sendOtp']);
    // Route::post('/verify', [TwilioController::class, 'verify']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[LoginController::class,'login'])->name('login');

});

Route::middleware('auth:sanctum')->group(function () {

});

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email already verified'], 400);
    }

    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification email sent']);
})->name('verification.send');

// Verify email
Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = User::findOrFail($id);

    // Check if the hash matches
    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return response()->json(['message' => 'Invalid verification link'], 400);
    }

    // Check if the user is already verified
    if ($user->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email already verified'], 200);
    }

    // Mark the user as verified
    $user->markEmailAsVerified();
    event(new Verified($user));

    return view('verify-success');
})->name('verification.verify');
