<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_id' => \App\Models\Shop::factory(),
            'user_id' => \App\Models\User::factory(),
            'status' => 'available', // Default status
            'redeemed_at' => null,
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
