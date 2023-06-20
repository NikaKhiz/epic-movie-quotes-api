<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$user = User::create([...$request->validated(), 'password' => bcrypt($request->password)]);
		event(new Registered($user));
		return response()->json(['success'], 204);
	}
}
