<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UpdateUserActiveEmailService
{
	public static function sendVerificationLink($userEmail)
	{
		$url = URL::temporarySignedRoute(
			'user.update_email',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id'   => auth()->id(),
				'hash' => sha1($userEmail),
			]
		);
		$verificationLink = str_replace(url('/api'), env('FRONT_URL'), $url) . '?email=' . $userEmail;
		Mail::send('emails.verification', ['url'=>$verificationLink, 'name'=>auth()->user()->name], function ($message) use ($userEmail) {
			$message
			->from('moviequotes@example.com', config('app.name'))
			->to($userEmail)
			->subject('Email Verification');
		});
	}
}
