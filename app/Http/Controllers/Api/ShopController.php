<?php

namespace App\Http\Controllers\Api;

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
        // Return shops with filters/sorting applied
        $shops = $this->getShopsQuery($request)->get();
        
        return response()->json($shops);
    }

    public function store(StoreShopRequest $request)
    {
        // Policy check is handled in Request or Controller? 
        // Request authorize() checks Auth::check(). 
        // We might want to ensure they are a shop owner if that's a requirement, 
        // but the previous code checked `!Auth::user()->isShopOwner()`.
        // Let's keep that check or move it to a Policy/Request. 
        // For now, I'll keep the explicit check or rely on the Request if I updated it.
        // The StoreShopRequest only checks Auth::check(). 
        // I should probably add the isShopOwner check here or in the Request.
        // Given the previous code had it, I'll add it back for safety, or better, rely on a Policy if I had one for 'create'.
        // Since I didn't make a 'create' policy, I'll check manually or assume the Request could be updated.
        // But to match previous logic exactly:
        if (!Auth::user()->isShopOwner()) {
             return response()->json(['message' => 'Unauthorized'], 403);
        }

        $shop = $this->createShopData(Auth::user(), $request->validated());

        return response()->json($shop, 201);
    }

    public function show(Shop $shop)
    {
        $data = $this->getShopData($shop, Auth::user());
        
        return response()->json($data);
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $shop = $this->updateShopData($shop, $request->validated());

        return response()->json($shop);
    }

    public function destroy(Shop $shop)
    {
        $this->authorize('delete', $shop);

        $shop->delete();

        return response()->json(['message' => 'Shop deleted successfully'], 200);
    }

    public function scan()
    {
        $user = Auth::user();
        
        if (!$user->isShopOwner()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $shop = $user->shops()->first();

        if (!$shop) {
            return response()->json(['message' => 'No shop found'], 404);
        }

        return response()->json([
            'shop' => $shop,
            'message' => 'Ready to scan customer QR codes'
        ]);
    }

    public function plans()
    {
        $plans = [
            'basic' => [
                'name' => 'Basic',
                'price' => 0,
                'features' => [
                    'List your shop on the platform',
                    'QR code scanning',
                    'Customer rewards tracking',
                    'Basic analytics'
                ]
            ],
            'premium' => [
                'name' => 'Premium',
                'price' => 29,
                'currency' => 'USD',
                'interval' => 'month',
                'features' => [
                    'Everything in Basic',
                    'Featured Badge on your shop',
                    'Top placement in search results',
                    'Enhanced shop card styling',
                    'Priority customer support',
                    'Advanced analytics & insights'
                ]
            ]
        ];

        return response()->json($plans);
    }

    public function upgrade(Shop $shop)
    {
        $this->authorize('update', $shop);

        $user = Auth::user();
        $priceId = env('STRIPE_PRICE_ID', 'price_1QRxyzABCDEF123456');

        try {
            $checkoutSession = $user->newSubscription('premium', $priceId)
                ->trialDays(0)
                ->checkout([
                    'success_url' => url('/api/shops/' . $shop->slug . '/payment/success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => url('/api/shops/' . $shop->slug . '/payment/cancel'),
                    'metadata' => [
                        'shop_id' => $shop->id,
                    ],
                ]);

            return response()->json([
                'checkout_url' => $checkoutSession->url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payment system is not configured yet. Please contact support.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function paymentSuccess(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $shop->update(['plan' => 'premium']);

        return response()->json([
            'message' => 'Successfully upgraded to Premium! Your shop is now featured.',
            'shop' => $shop
        ]);
    }

    public function paymentCancel(Shop $shop)
    {
        return response()->json([
            'message' => 'Payment was cancelled. You can try again anytime.'
        ], 200);
    }
}
