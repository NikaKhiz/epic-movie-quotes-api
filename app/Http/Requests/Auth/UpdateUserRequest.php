<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name'                   => ['nullable', 'alpha', 'lowercase', 'min:3', 'max:15', Rule::unique('users', 'name')->ignore(auth()->id())],
			'email'                  => ['nullable', 'email',  Rule::unique('users', 'email')->ignore(auth()->id())],
			'profile_picture'        => 'nullable|image|mimes:png,jpg,svg',
			'password'               => 'nullable|alpha_num|lowercase|min:8|max:15|confirmed',
			'password_confirmation'  => 'nullable',
		];
	}
}
