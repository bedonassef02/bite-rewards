<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index(Request $request)
    {
        $query = Shop::with('owner');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sort = $request->input('sort', 'newest');

        // Always prioritize premium shops
        $query->orderByRaw("CASE WHEN plan = 'premium' THEN 1 ELSE 2 END");

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

        $shops = $query->paginate(9);
        
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(StoreShopRequest $request)
    {
        $this->shopService->createShop(Auth::user(), $request->validated());

        return redirect()->route('dashboard')->with('status', 'Shop created successfully!');
    }

    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop);
        return view('shops.edit', compact('shop'));
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $this->shopService->updateShop($shop, $request->validated());

        return redirect()->route('dashboard')->with('status', 'Shop updated successfully!');
    }

    public function show(Shop $shop)
    {
        $user = Auth::user();
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

        return view('shops.show', compact('shop', 'visitCount', 'progress', 'rewards', 'history'));
    }

    public function scan()
    {
        // Ensure user has a shop
        $shop = Auth::user()->shops()->first();
        if (!$shop) {
            return redirect()->route('shops.create')->with('error', 'Please create a shop first.');
        }
        
        $this->authorize('scan', $shop);
        
        return view('shops.scan', compact('shop'));
    }

    public function plans()
    {
        return view('shops.plans');
    }

    public function upgrade(Shop $shop)
    {
        $this->authorize('update', $shop);

        $shop->update(['plan' => 'premium']);

        return redirect()->route('dashboard')->with('status', 'Successfully upgraded to Premium! Your shop is now featured.');
    }
}
