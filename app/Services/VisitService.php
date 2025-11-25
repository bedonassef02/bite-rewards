<?php

namespace App\Services;

use App\Models\Reward;
use App\Models\Shop;
use App\Models\User;
use App\Models\Visit;

class VisitService
{
    /**
     * Record a visit and check for rewards.
     */
    public function recordVisit(Shop $shop, User $customer): array
    {
        // Check if customer already visited today
        $existingVisitToday = Visit::where('user_id', $customer->id)
            ->where('shop_id', $shop->id)
            ->whereDate('visited_at', today())
            ->exists();

        if ($existingVisitToday) {
            return [
                'success' => false,
                'message' => 'You have already visited this shop today. Come back tomorrow!',
                'total_visits' => Visit::where('user_id', $customer->id)
                    ->where('shop_id', $shop->id)
                    ->count(),
                'reward_earned' => false,
            ];
        }

        // 1. Create Visit
        Visit::create([
            'user_id' => $customer->id,
            'shop_id' => $shop->id,
            'visited_at' => now(),
        ]);

        // 2. Check Visit Count
        $count = Visit::where('user_id', $customer->id)
            ->where('shop_id', $shop->id)
            ->count();

        // 3. Check for Reward
        $rewardEarned = ($count % $shop->visits_required) === 0;

        if ($rewardEarned) {
            Reward::create([
                'user_id' => $customer->id,
                'shop_id' => $shop->id,
                'status' => 'available',
            ]);
        }

        return [
            'success' => true,
            'message' => 'Visit recorded!',
            'total_visits' => $count,
            'reward_earned' => $rewardEarned,
        ];
    }
}
