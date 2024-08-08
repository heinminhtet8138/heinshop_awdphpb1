<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codeNo' => $this->faker->ean8,
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(10000,1000000),
            'image' => $this->faker->imageUrl,
            'inStock' => rand(0,1),
            'discount' => rand(0,1000),
            'category_id' => rand(1,10)
        ];
    }
}
