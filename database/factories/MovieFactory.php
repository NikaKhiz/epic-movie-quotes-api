<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
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
			'user_id'         => 1,
			'director'        => ['en' => $this->faker->name(), 'ka' => $fakerKa->realText(10)],
			'title'           => ['en' => $this->faker->sentence(), 'ka' => $fakerKa->realText(20)],
			'description'     => ['en' => $this->faker->sentence(), 'ka' => $fakerKa->realText(100)],
			'released'        => $this->faker->year(),
			'thumbnail'       => 'thumbnails/' . $this->faker->image(storage_path('/app/public/thumbnails'), 400, 300, null, false),
		];
	}
}
