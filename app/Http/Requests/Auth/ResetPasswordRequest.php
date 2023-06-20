<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'email'                 => 'required|email',
			'token'                 => 'required',
			'password'              => 'required|alpha_num|lowercase|min:8|max:15|confirmed',
			'password_confirmation' => 'required',
		];
	}
}
