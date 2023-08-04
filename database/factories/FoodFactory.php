<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(1, 2)),
            'price' => $this->faker->numberBetween(5000, 100000),
            'description' => $this->faker->sentence(mt_rand(3, 5)),
        ];
    }
}
