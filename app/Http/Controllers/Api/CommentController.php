<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request): JsonResponse
	{
		Comment::create([
			...$request->validated(),
			'user_id'=> auth()->id(),
		]);
		return response()->json([], 204);
	}
}
