<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        // Customer sees their own visits
        return response()->json(Auth::user()->visits()->with('shop:id,name')->get());
    }

    public function store(Request $request)
    {
        // Only shop owners can record visits
        if (!Auth::user()->isShopOwner()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $shop = Shop::findOrFail($request->shop_id);

        // Verify the authenticated user owns this shop
        if ($shop->user_id !== Auth::id()) {
            return response()->json(['message' => 'You do not own this shop'], 403);
        }

        // Verify the customer is actually a customer
        $customer = User::findOrFail($request->customer_id);
        if (!$customer->isCustomer()) {
             return response()->json(['message' => 'User is not a customer'], 400);
        }

        // Record visit
        $visit = Visit::create([
            'user_id' => $customer->id,
            'shop_id' => $shop->id,
            'visited_at' => now(),
        ]);

        // Check progress
        $visitCount = Visit::where('user_id', $customer->id)
            ->where('shop_id', $shop->id)
            ->count();

        $rewardEarned = false;
        if ($visitCount % $shop->visits_required === 0) {
            $rewardEarned = true;
        }

        return response()->json([
            'message' => 'Visit recorded successfully',
            'visit' => $visit,
            'total_visits' => $visitCount,
            'reward_earned' => $rewardEarned,
        ]);
    }
}
