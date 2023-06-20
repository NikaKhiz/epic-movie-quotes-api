<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerifyRequest extends FormRequest
{
	protected $user;

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		$this->user = User::findOrfail($this->route('id'));
		if (!hash_equals((string) $this->route('id'), (string) $this->user->getKey())) {
			return false;
		}
		if (!hash_equals((string) $this->route('hash'), sha1($this->user->getEmailForVerification()))) {
			return false;
		}
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
		];
	}

	/**
	 * Fulfill the email verification request.
	 *
	 * @return void
	 */
	public function fulfill()
	{
		if (!$this->user->hasVerifiedEmail()) {
			$this->user->markEmailAsVerified();
			event(new Verified($this->user));
		}
	}
}
