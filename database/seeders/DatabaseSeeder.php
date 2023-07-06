<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		Storage::deleteDirectory('thumbnails');
		Storage::makeDirectory('thumbnails');
		\App\Models\Movie::factory(15)->create();
		$genres = Genre::all();
		$movies = Movie::all();
		$movies->each(function ($movie) use ($genres) {
			$movie->genres()->attach(
				$genres->random(1, 3)
			);
		});
	}
}
