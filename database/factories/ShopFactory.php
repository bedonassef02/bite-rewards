<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->company() . ' ' . $this->faker->randomElement(['Cafe', 'Bakery', 'Bistro', 'Coffee', 'Eats']),
            'description' => $this->faker->paragraph(),
            'visits_required' => $this->faker->numberBetween(5, 10),
            'reward_name' => 'Free ' . $this->faker->randomElement(['Coffee', 'Pastry', 'Sandwich', 'Drink']),
            'plan' => $this->faker->randomElement(['basic', 'basic', 'basic', 'premium']), // 25% chance of premium
            // logo_path and reward_image_path can be null or fake paths
        ];
    }
}
