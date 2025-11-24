<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a Shop Owner
        $owner = User::factory()->create([
            'name' => 'Shop Owner',
            'email' => 'owner@bite.com',
            'password' => bcrypt('password'),
            'role' => 'shop_owner',
        ]);

        // Create a Shop for the Owner
        $shop = Shop::factory()->create([
            'user_id' => $owner->id,
            'name' => 'Bite Coffee',
            'slug' => 'bite-coffee',
            'description' => 'The best coffee in town. Earn rewards for every cup!',
            'visits_required' => 5,
            'reward_name' => 'Free Coffee',
        ]);

        // Create a Customer
        $customer = User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@bite.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Create Visits for the Customer
        Visit::factory()->count(3)->create([
            'shop_id' => $shop->id,
            'user_id' => $customer->id,
        ]);

        // Create some random shops
        Shop::factory()->count(5)->create();
    }
}
