<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(3, false),
            'description' => $this->faker->sentences(3, true),
            'content' => $this->faker->text(500, true),
            'user_id' => $this->faker->numberBetween(1,3),
            'category_id' => $this->faker->numberBetween(1,3),
        ];
    }
}
