<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $shops = Shop::with('owner')->latest()->get();
        $totalUsers = \App\Models\User::count();
        $totalShops = Shop::count();
        $totalVisits = \App\Models\Visit::count();

        return response()->json([
            'shops' => $shops,
            'stats' => [
                'total_users' => $totalUsers,
                'total_shops' => $totalShops,
                'total_visits' => $totalVisits
            ]
        ]);
    }

    public function deleteShop(Shop $shop)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $shop->delete();

        return response()->json(['message' => 'Shop deleted successfully'], 200);
    }
}
