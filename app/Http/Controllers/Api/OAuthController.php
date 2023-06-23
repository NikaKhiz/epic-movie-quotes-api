<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
	public function providerRedirect()
	{
		$redirectUrl = Socialite::driver('google')->redirect()->getTargetUrl();
		return response()->json(['url'=>$redirectUrl], 200);
	}

	public function providerCallback()
	{
		$user = Socialite::driver('google')->user();
		$user = User::updateOrCreate([
			'email' => $user->email,
		], [
			'name'                     => $user->name,
			'google_id'                => $user->id,
		]);
		Auth::login($user);
		return response()->json(['user'=>$user], 200);
	}
}
