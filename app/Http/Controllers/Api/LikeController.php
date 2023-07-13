<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
	public function store(Quote $quote): JsonResponse
	{
		$liked = $quote->users()->where('user_id', auth()->id())->first();
		if ($liked) {
			$quote->users()->detach();
			return response()->json(['like'=>false], 200);
		} else {
			$quote->users()->attach([auth()->id()]);
			return response()->json(['like'=>true], 200);
		}
	}

	public function index(Quote $quote): JsonResponse
	{
		$liked = $quote->users()->where('user_id', auth()->id())->first();
		if ($liked) {
			return response()->json(['liked'=>true], 200);
		} else {
			return response()->json(['liked'=>false], 200);
		}
	}
}
