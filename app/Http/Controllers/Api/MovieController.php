<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
	public function index(): JsonResponse
	{
		$user = auth()->user();
		$movies = MovieResource::collection($user->movies->orderBy('created_at')->with('genres')->paginate(20));
		return response()->json(['movies'=>$movies]);
	}

	public function show(Movie $movie): JsonResponse
	{
		$currentMovie = new MovieResource($movie);
		return response()->json(['movie'=>$currentMovie]);
	}

	public function store(StoreMovieRequest $request): JsonResponse
	{
		$movie = Movie::create([...$request->validated()]);
		$genres = [...$request['genres']];
		$movie->genres()->attach($genres);
		return response()->json(['success', 204]);
	}

	public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
	{
		$movie->update([...$request->validated()]);
		$genres = [...$request['genres']];
		$movie->genres()->attach($genres);
		return response()->json(['success', 204]);
	}

	public function destroy(Movie $movie): JsonResponse
	{
		$movie->genres()->detach();
		$movie->delete();
		return response()->json(['success', 204]);
	}
}
