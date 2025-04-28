<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->sentence(3),
            'name' => $this->faker->sentence(2),
            'quantity' => $this->faker->randomFloat(min: 1, max: 10),
            'unit' => $this->faker->sentence(1),
            'price' => $this->faker->randomFloat(min: 1, max: 10),
            'stock' => $this->faker->randomFloat(min: 1, max: 10),
        ];
    }
}
