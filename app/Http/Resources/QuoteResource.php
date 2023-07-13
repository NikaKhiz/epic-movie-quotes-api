<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class QuoteResource extends JsonResource
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
			'title'                           => $this->title,
			'title_ka'                        => parent::toArray($request)['title']['ka'],
			'thumbnail'                       => Storage::url($this->thumbnail),
			'comments'                        => CommentResource::collection($this->comments),
			'likes'                           => LikeResource::collection($this->likes),
		];
	}
}
