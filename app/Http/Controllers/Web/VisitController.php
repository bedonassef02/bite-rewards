<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $shop = Shop::findOrFail($request->shop_id);
        
        if ($shop->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $customer = User::findOrFail($request->customer_id);

        Visit::create([
            'user_id' => $customer->id,
            'shop_id' => $shop->id,
            'visited_at' => now(),
        ]);

        $count = Visit::where('user_id', $customer->id)
            ->where('shop_id', $shop->id)
            ->count();
        
        $rewardEarned = ($count % $shop->visits_required) === 0;

        if ($rewardEarned) {
            \App\Models\Reward::create([
                'user_id' => $customer->id,
                'shop_id' => $shop->id,
                'status' => 'available',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Visit recorded!',
            'total_visits' => $count,
            'reward_earned' => $rewardEarned
        ]);
    }
}
