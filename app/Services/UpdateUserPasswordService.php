<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordService
{
	public static function updateUserPassword($request, $user)
	{
		$user->update(['password'=> Hash::make($request->password)]);
	}
}
