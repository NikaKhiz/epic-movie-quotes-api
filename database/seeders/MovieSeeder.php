<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Movie::factory()->count(15)->create();
		$genres = Genre::all();
		$movies = Movie::all();
		$movies->each(function ($movie) use ($genres) {
			$movie->genres()->attach(
				$genres->random(1, 3)
			);
		});
	}
}
