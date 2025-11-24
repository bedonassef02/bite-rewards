<?php

namespace App\Http\Controllers\Traits;

use App\Models\Shop;
use Illuminate\Http\Request;

trait ManagesShops
{
    /**
     * Get shops query with filters and sorting applied
     */
    protected function getShopsQuery(Request $request)
    {
        $query = Shop::with('owner');

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Always prioritize premium shops
        $query->orderByRaw("CASE WHEN plan = 'premium' THEN 1 ELSE 2 END");

        // Apply sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc')->orderBy('id', 'asc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');
                break;
        }

        return $query;
    }

    /**
     * Get shop data with user-specific information
     */
    protected function getShopData(Shop $shop, $user)
    {
        $visitCount = 0;
        $progress = 0;
        $rewards = [];
        $history = [];

        if ($user->id === $shop->user_id) {
            // Shop Owner View: See all history
            $history = $shop->visits()
                ->with('customer')
                ->latest('visited_at')
                ->limit(50)
                ->get();

            $rewards = \App\Models\Reward::where('shop_id', $shop->id)
                ->whereNotNull('redeemed_at')
                ->with('user')
                ->latest('redeemed_at')
                ->limit(50)
                ->get();
        } elseif ($user->isCustomer()) {
            // Customer View: See own history
            $visitCount = $shop->visits()->where('user_id', $user->id)->count();
            
            // Calculate progress towards next reward
            $visitsRequired = $shop->visits_required;
            $currentCycleVisits = $visitCount % $visitsRequired;
            $progress = ($currentCycleVisits / $visitsRequired) * 100;

            // Fetch Rewards
            $rewards = \App\Models\Reward::where('user_id', $user->id)
                ->where('shop_id', $shop->id)
                ->where('status', 'available')
                ->get();

            // Fetch History
            $history = $shop->visits()
                ->where('user_id', $user->id)
                ->latest('visited_at')
                ->limit(10)
                ->get();
        }

        return compact('shop', 'visitCount', 'progress', 'rewards', 'history');
    }

    /**
     * Create shop using service
     */
    protected function createShopData($user, array $validatedData)
    {
        return $this->shopService->createShop($user, $validatedData);
    }

    /**
     * Update shop using service
     */
    protected function updateShopData(Shop $shop, array $validatedData)
    {
        return $this->shopService->updateShop($shop, $validatedData);
    }
}
