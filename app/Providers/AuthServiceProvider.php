<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
			$verifyUrl = str_replace(url('/api'), env('FRONT_URL'), $url) . '?email=' . $notifiable->getEmailForVerification();

			return (new MailMessage)
			->from('moviequotes@example.com', config('app.name'))
			->subject('Email Verification')
			->view(
				'emails.verification',
				['url' => $verifyUrl, 'name' => $notifiable->name]
			);
		});
	}
}
