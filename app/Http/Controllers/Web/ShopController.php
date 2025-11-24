<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ManagesShops;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    use ManagesShops;

    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index(Request $request)
    {
        $shops = $this->getShopsQuery($request)->paginate(9);
        
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(StoreShopRequest $request)
    {
        $this->createShopData(Auth::user(), $request->validated());

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

        $this->updateShopData($shop, $request->validated());

        return redirect()->route('dashboard')->with('status', 'Shop updated successfully!');
    }

    public function show(Shop $shop)
    {
        $data = $this->getShopData($shop, Auth::user());
        
        return view('shops.show', $data);
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

        $user = Auth::user();

        // Get Stripe Price ID from environment
        $priceId = env('STRIPE_PRICE_ID', 'price_1QRxyzABCDEF123456'); // Replace with your actual Price ID

        try {
            // Create Stripe Checkout Session
            return $user->newSubscription('premium', $priceId)
                ->trialDays(0)
                ->checkout([
                    'success_url' => route('shops.payment.success', ['shop' => $shop->slug]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('shops.payment.cancel', ['shop' => $shop->slug]),
                    'metadata' => [
                        'shop_id' => $shop->id,
                    ],
                ]);
        } catch (\Exception $e) {
            return redirect()->route('shops.plans')->with('error', 'Payment system is not configured yet. Please contact support.');
        }
    }

    public function paymentSuccess(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        // Update shop to premium
        $shop->update(['plan' => 'premium']);

        return redirect()->route('dashboard')->with('status', 'Successfully upgraded to Premium! Your shop is now featured.');
    }

    public function paymentCancel(Shop $shop)
    {
        return redirect()->route('shops.plans')->with('error', 'Payment was cancelled. You can try again anytime.');
    }
}
