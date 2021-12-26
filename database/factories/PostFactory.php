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
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->words(3, true),
            'content' => $this->faker->paragraph(10),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'views' => $this->faker->numberBetween($min = 10., $max = 9000),
            'category_id' => $this->faker->numberBetween(17,21),
            'thumbnail' =>$this->faker->imageUrl($width = 800, $height = 460),
        ];
    }
}
