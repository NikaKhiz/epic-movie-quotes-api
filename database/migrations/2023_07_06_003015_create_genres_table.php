<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected $genres = [
		'Action',
		'Adventure',
		'Animated',
		'Biography',
		'Comedy',
		'Crime',
		'Dance',
		'Disaster',
		'Documentary',
		'Drama',
		'Erotic',
		'Family',
		'Fantasy',
		'Found Footage',
		'Historical',
		'Horror',
		'Independent',
		'Legal',
		'Live Action',
		'Martial Arts',
		'Musical',
		'Mystery',
		'Noir',
		'Performance',
		'Political',
		'Romance',
		'Satire',
		'Science Fiction',
		'Short',
		'Silent',
		'Slasher',
		'Sports',
		'Spy',
		'Superhero',
		'Supernatural',
		'Suspense',
		'Teen',
		'Thriller',
		'War',
		'Western',
	];

	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('genres', function (Blueprint $table) {
			$table->id();
			$table->string('genre');
			$table->timestamps();
		});
		foreach ($this->genres as $genre) {
			DB::table('genres')->updateOrInsert(
				['genre'=>$genre]
			);
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('genres');
	}
};
