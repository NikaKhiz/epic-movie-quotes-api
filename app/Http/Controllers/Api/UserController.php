<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateEmailRequest as AuthUpdateEmailRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UpdateUserActiveEmailService;
use App\Services\UpdateUserNameService;
use App\Services\UpdateUserPasswordService;
use App\Services\UpdateUserProfilePictureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	private UpdateUserActiveEmailService $userEmailService;

	private UpdateUserNameService $userNameService;

	private UpdateUserPasswordService $userPasswordService;

	private UpdateUserProfilePictureService $userProfilePictureService;

	public function __construct(
		UpdateUserActiveEmailService $userEmailService,
		UpdateUserNameService $userNameService,
		UpdateUserPasswordService $userPasswordService,
		UpdateUserProfilePictureService $userProfilePictureService
	) {
		$this->userEmailService = $userEmailService;
		$this->userNameService = $userNameService;
		$this->userPasswordService = $userPasswordService;
		$this->userProfilePictureService = $userProfilePictureService;
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
			$this->userNameService->updateUserName($request, $user);
			return response()->json(['name'=>'profile name has been changed succesfully!'], 200);
		}
		if ($userEmail) {
			$this->userEmailService->sendVerificationLink($request, $user);
			return response()->json(['email'=>'Check following email first and verify it!'], 200);
		}
		if ($password) {
			$this->userPasswordService->updateUserPassword($request, $user);
			return response()->json(['message'=>'password has been changed succesfully!'], 200);
		}
		if ($profilePicture) {
			$this->userProfilePictureService->updateUserProfilePicture($request, $user);
			return response()->json(['profile_picture'=>'profile picture has been changed succesfully!'], 200);
		}
	}

	public function updateEmail(AuthUpdateEmailRequest $request): JsonResponse
	{
		Auth::user()->update(['email'=> $request->email]);
		return response()->json(['email'=>'email has been changed succesfully!'], 200);
	}
}
