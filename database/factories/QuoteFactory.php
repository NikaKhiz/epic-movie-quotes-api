<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$fakerKa = \Faker\Factory::create('ka_GE');
		return [
			'user_id'  => User::factory(),
			'movie_id' => Movie::factory(),
			'title'    => ['en'=>fake()->sentence(), 'ka'=>$fakerKa->realText(10)],
			'thumbnail'=> 'thumbnails/' . $this->faker->image(storage_path('/app/public/thumbnails'), 400, 300, null, false),
		];
	}
}
