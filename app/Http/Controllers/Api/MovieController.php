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
		$movie = Movie::where('user_id', '=', auth()->id())->orderBy('created_at')->with('genres')->paginate(20);
		$movies = MovieResource::collection($movie);
		return response()->json(['movies'=>$movies]);
	}

	public function show(Movie $movie): JsonResponse
	{
		$currentMovie = new MovieResource($movie);
		return response()->json(['movie'=>$currentMovie]);
	}

	public function store(StoreMovieRequest $request): JsonResponse
	{
		$movie = Movie::create([
			...$request->validated(),
			'thumbnail'      => $request->file('thumbnail')->store('thumbnails'),
			'title'          => ['en' => $request->title, 'ka' => $request->title_ka],
			'director'       => ['en' => $request->director, 'ka' => $request->director_ka],
			'description'    => ['en' => $request->description, 'ka' => $request->description_ka],
			'user_id'        => auth()->user()->id,
		]);
		$genres = [...$request['genres']];
		$movie->genres()->attach($genres);
		return response()->json(['success', 204]);
	}

	public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
	{
		$movie->update([
			...$request->validated(),
			'thumbnail'   => $request->file('thumbnail')->store('thumbnails'),
			'title'       => ['en' => $request->title, 'ka' => $request->title_ka],
			'director'    => ['en' => $request->director, 'ka' => $request->director_ka],
			'description' => ['en' => $request->description, 'ka' => $request->description_ka],
			'user'        => auth()->user()->id,
		]);
		$genres = [...$request['genres']];
		$movie->genres()->detach();
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
