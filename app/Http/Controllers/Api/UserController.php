<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateEmailRequest as AuthUpdateEmailRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UpdateUserActiveEmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	private UpdateUserActiveEmailService $userEmailService;

	public function __construct(UpdateUserActiveEmailService $userEmailService)
	{
		$this->userEmailService = $userEmailService;
	}

	public function getUser(): JsonResponse
	{
		return response()->json(['user'=>new UserResource(auth()->user())], 200);
	}

	public function update(UpdateUserRequest $request): JsonResponse
	{
		$user = Auth::user();
		$userName = $request->name;
		$userEmail = $request->email;
		$password = $request->password;
		$profilePicture = $request->profile_picture;

		if ($userName) {
			$user->update(['name'=>$request->name]);
			return response()->json(['name'=>'profile name has been changed succesfully!'], 200);
		}
		if ($userEmail) {
			$this->userEmailService->sendVerificationLink($userEmail);
			return response()->json(['email'=>'Check following email first and verify it!'], 200);
		}
		if ($password) {
			$user->update(['password'=> Hash::make($request->password)]);
			return response()->json(['message'=>'password has been changed succesfully!'], 200);
		}
		if ($profilePicture) {
			$user->update(['profile_picture'=> $request->file('profile_picture')->store('thumbnails')]);
			return response()->json(['profile_picture'=>'profile picture has been changed succesfully!'], 200);
		}
	}

	public function updateEmail(AuthUpdateEmailRequest $request): JsonResponse
	{
		Auth::user()->update(['email'=> $request->email]);
		return response()->json(['email'=>'email has been changed succesfully!'], 200);
	}
}
