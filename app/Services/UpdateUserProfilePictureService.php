<?php

namespace App\Services;

class UpdateUserProfilePictureService
{
	public static function updateUserProfilePicture($request, $user)
	{
		$user->update(['profile_picture'=> $request->file('profile_picture')->store('thumbnails')]);
	}
}
