<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Requests\Quote\UpdateQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function index(): JsonResponse
	{
		$quote = Quote::latest()->paginate(20);
		return response()->json(['quotes'=>QuoteResource::collection($quote)]);
	}

	public function show(Quote $quote): JsonResponse
	{
		$currentQuote = new QuoteResource($quote);
		return response()->json(['quote'=>$currentQuote]);
	}

	public function store(StoreQuoteRequest $request): JsonResponse
	{
		Quote::create([
			...$request->validated(),
			'thumbnail'         => $request->file('thumbnail')->store('thumbnails'),
			'title'             => ['en' => $request->title, 'ka' => $request->title_ka],
			'user_id'           => auth()->user()->id,
		]);
		return response()->json(['success', 204]);
	}

	public function update(UpdateQuoteRequest $request, Quote $quote): JsonResponse
	{
		$quote->update([
			...$request->validated(),
			'thumbnail'          => $request->file('thumbnail')->store('thumbnails'),
			'title'              => ['en' => $request->title, 'ka' => $request->title_ka],
			'user_id'            => auth()->user()->id,
		]);
		return response()->json(['success', 204]);
	}

	public function destroy(Quote $quote): JsonResponse
	{
		$quote->delete();
		return response()->json(['success', 204]);
	}
}
