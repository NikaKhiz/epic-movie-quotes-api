<?php

namespace App\Services;

class UpdateUserNameService
{
	public static function updateUserName($request, $user)
	{
		$user->update(['name'=>$request->name]);
	}
}
