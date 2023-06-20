<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\EmailVerifyRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$user = User::create([...$request->validated(), 'password' => bcrypt($request->password)]);
		event(new Registered($user));
		return response()->json(['success'], 204);
	}

	public function verifyEmail(EmailVerifyRequest $request)
	{
		$request->fulfill();
		return response()->json(['success'], 204);
	}

	public function login(LoginRequest $request)
	{
		$fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
		$isUserVerified = User::firstWhere($fieldType, $request->email)['email_verified_at'] !== null;
		if ($isUserVerified) {
			if (auth()->attempt($request->validated(), $request->has('remember'))) {
				session()->regenerate();
				return  response()->json(['success'], 204);
			} else {
				return response()->json(['errors' => ['email' => ['provided credentials are incorrect']]], 401);
			}
		} else {
			return response()->json(['errors'=> ['email' => ['user is not verified']]], 403);
		}
	}

	public function sendPasswordResetLink(RecoverPasswordRequest $request)
	{
		$status = Password::sendResetLink(
			$request->validated()
		);
		if ($status === Password::RESET_LINK_SENT) {
			return response()->json([], 204);
		} else {
			return response()->json(['errors'=>['email' => [__($status)]]], 400);
		}
	}
}
