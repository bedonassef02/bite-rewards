<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isShopOwner()) {
            $shop = $user->shops()->first();
            $stats = [
                'total_visits' => 0,
                'total_rewards' => 0,
                'recent_visits' => []
            ];

            if ($shop) {
                $stats['total_visits'] = $shop->visits()->count();
                $stats['total_rewards'] = \App\Models\Reward::where('shop_id', $shop->id)->count();
                $stats['recent_visits'] = $shop->visits()->with('customer')->latest('visited_at')->limit(5)->get();
            }

            return view('dashboard', ['role' => 'shop_owner', 'stats' => $stats, 'shop' => $shop]);
        }

        return redirect()->route('shops.index');
    }
}
