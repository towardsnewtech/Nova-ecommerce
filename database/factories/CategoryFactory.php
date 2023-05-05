<?php

namespace Database\Factories;

use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'image' => null,
            'parent_id' => 0,
            'sorting' => fake()->randomNumber(2),
            'visible' => fake()->boolean(),
            'description' => fake()->text(),
        ];
    }
}
