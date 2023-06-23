<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::controller(AuthController::class)->group(function () {
	Route::post('/register', 'register')->name('register');
	Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
	Route::post('/reverify-email', 'resendEmailVerificationLink')->name('reverify_email');
	Route::post('/login', 'login')->name('login');
	Route::post('/forgot-password', 'sendPasswordResetLink')->name('forgot_password');
	Route::post('/reset-password', 'resetPassword')->name('reset_password');
	Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('web')->controller(OAuthController::class)->group(function () {
	Route::get('/auth/google/redirect', 'providerRedirect')->name('google_redirect');
	Route::get('/auth/google/callback', 'providerCallback')->name('google_callback');
});
