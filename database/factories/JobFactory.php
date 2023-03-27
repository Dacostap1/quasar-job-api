<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'title' => fake()->jobTitle(),
      'description' => fake()->paragraph(),
      'company' => fake()->company(),
      'salary' => fake()->numberBetween(3500, 6000),
      'tag' => fake()->randomElement(['Freelance', 'Part-time', 'Full-time'])
    ];
  }
}
