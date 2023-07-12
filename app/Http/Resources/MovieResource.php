<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MovieResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'                              => $this->id,
			'director'                        => $this->director,
			'director_ka'                     => parent::toArray($request)['director']['ka'],
			'title'                           => $this->title,
			'title_ka'                        => parent::toArray($request)['title']['ka'],
			'description'                     => $this->description,
			'description_ka'                  => parent::toArray($request)['description']['ka'],
			'released'                        => $this->released,
			'thumbnail'                       => Storage::url($this->thumbnail),
			'genres'                          => GenreResource::collection($this->genres),
		];
	}
}
