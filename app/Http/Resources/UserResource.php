<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'google_accaunt'    => $this->google_id && true,
			'name'              => $this->name,
			'email'             => $this->email,
			'profile_picture'   => $this->profile_picture ? Storage::url($this->profile_picture) : null,
		];
	}
}
