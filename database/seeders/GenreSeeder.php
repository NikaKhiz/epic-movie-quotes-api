<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Traits\GenreListTrait;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
	use GenreListTrait;

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$genres = $this->getGenres();
		foreach ($genres as $genre) {
			Genre::updateOrInsert(
				['genre' => $genre]
			);
		}
	}
}
