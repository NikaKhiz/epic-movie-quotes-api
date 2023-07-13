<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
	public function store(Quote $quote): JsonResponse
	{
		$liked = $quote->likes()->where('user_id', auth()->id())->first();
		if ($liked) {
			$liked->delete();
		} else {
			$quote->likes()->create([
				'user_id' => auth()->user()->id,
			]);
		}
		return response()->json(['succes', 204]);
	}
}
