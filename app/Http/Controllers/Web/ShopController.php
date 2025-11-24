<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('owner')->get();
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visits_required' => 'integer|min:1',
            'logo' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo_path'] = $path;
        }

        Auth::user()->shops()->create($data);

        return redirect()->route('dashboard')->with('status', 'Shop created successfully!');
    }

    public function show(Shop $shop)
    {
        $user = Auth::user();
        $visitCount = 0;
        $progress = 0;

        $rewards = [];
        $history = [];

        if ($user->isCustomer()) {
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

        return view('shops.show', compact('shop', 'visitCount', 'progress', 'rewards', 'history'));
    }

    public function scan()
    {
        // Ensure user has a shop
        $shop = Auth::user()->shops()->first();
        if (!$shop) {
            return redirect()->route('shops.create')->with('error', 'Please create a shop first.');
        }
        return view('shops.scan', compact('shop'));
    }
}
