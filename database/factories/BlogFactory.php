<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'sum' => $this->faker->paragraph(),
            'category' => $this->faker->word(),
            'tags' => '["Haha", "Hehe", "Hoho"]',
            // 'timg' => $this->faker->imageUrl(),
            // 'article' => $this->faker->text()
        ];
    }
}
