<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isShopOwner()) {
            $shop = $user->shops()->first();

            if (!$shop) {
                return response()->json([
                    'message' => 'No shop registered yet',
                    'has_shop' => false
                ]);
            }

            $stats = [
                'total_visits' => $shop->visits()->count(),
                'total_rewards' => \App\Models\Reward::where('shop_id', $shop->id)
                    ->whereNotNull('redeemed_at')
                    ->count(),
                'active_customers' => $shop->visits()->distinct('user_id')->count()
            ];

            return response()->json([
                'user' => $user,
                'shop' => $shop,
                'stats' => $stats,
                'has_shop' => true
            ]);
        }

        // Customer dashboard
        $visits = $user->visits()->with('shop')->latest()->limit(10)->get();
        $rewards = \App\Models\Reward::where('user_id', $user->id)
            ->where('status', 'available')
            ->with('shop')
            ->get();

        return response()->json([
            'user' => $user,
            'recent_visits' => $visits,
            'available_rewards' => $rewards
        ]);
    }
}
