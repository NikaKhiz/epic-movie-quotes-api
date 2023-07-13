<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'title'         => 'required|min:6|max:255',
			'title_ka'      => 'required|min:6|max:255',
			'thumbnail'     => 'nullable|image|mimes:png,jpg,svg',
			'movie_id'      => 'required|exists:movie,id',
		];
	}
}
