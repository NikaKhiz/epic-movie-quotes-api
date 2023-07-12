<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'director'      => 'required|min:6|max:255',
			'director_ka'   => 'required|min:6|max:255',
			'title'         => ['required', 'min:6', 'max:255', Rule::unique('movies', 'title->en')],
			'title_ka'      => ['required', 'min:6', 'max:255', Rule::unique('movies', 'title->ka')],
			'description'   => 'required|min:6|max:255',
			'description_ka'=> 'required|min:6|max:255',
			'released'      => 'required|string|min:4|max:4',
			'genres'        => 'required|array',
			'thumbnail'     => 'nullable|image|mimes:png,jpg,svg',
		];
	}
}
