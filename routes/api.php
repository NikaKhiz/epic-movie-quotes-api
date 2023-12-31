<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\OAuthController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
	Route::controller(UserController::class)->group(function () {
		Route::get('/user', 'getUser')->name('user.get_user');
		Route::post('/user/update', 'update')->name('user.update');
		Route::post('/email/update/{id}/{hash}', 'updateEmail')->middleware('signed')->name('user.update_email');
	});

	Route::get('/genres', [GenreController::class, 'index']);
	Route::controller(MovieController::class)->prefix('movies')->group(function () {
		Route::get('/', 'index')->name('movies.index');
		Route::get('/{movie}', 'show')->name('movies.show');
		Route::post('/', 'store')->name('movies.store');
		Route::post('/{movie}', 'update')->name('movies.update');
		Route::delete('/{movie}', 'destroy')->name('movies.destroy');
	});

	Route::controller(QuoteController::class)->prefix('quotes')->group(function () {
		Route::get('/', 'index')->name('quotes.index');
		Route::get('/{quote}', 'show')->name('quotes.show');
		Route::post('/', 'store')->name('quotes.store');
		Route::post('/{quote}', 'update')->name('quotes.update');
		Route::delete('/{quote}', 'destroy')->name('quotes.destroy');
	});

	Route::post('/quotes/{quote}/comment', [CommentController::class, 'store'])->name('comments.store');
	Route::get('/quotes/{quote}/like', [LikeController::class, 'store'])->name('like.store');
	Route::get('/quotes/{quote}/liked', [LikeController::class, 'index'])->name('like.index');
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
