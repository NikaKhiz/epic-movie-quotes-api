<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

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
			'title'         => 'required|min:6|max:255|unique:movies,title',
			'title_ka'      => 'required|min:6|max:255|unique:movies,title_ka',
			'description'   => 'required|min:6|max:255',
			'description_ka'=> 'required|min:6|max:255',
			'released'      => 'required',
			'thumbnail'     => 'nullable|image|mimes:png,jpg,svg',
		];
	}
}
