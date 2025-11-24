<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitRequest;
use App\Models\Shop;
use App\Models\User;
use App\Services\VisitService;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    protected $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }

    public function index()
    {
        // Customer sees their own visits
        return response()->json(Auth::user()->visits()->with('shop:id,name')->get());
    }

    public function store(StoreVisitRequest $request)
    {
        // Only shop owners can record visits
        if (!Auth::user()->isShopOwner()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $shop = Shop::findOrFail($request->shop_id);

        // Verify the authenticated user owns this shop
        // This logic is also in the Web Controller, but not in the Service.
        // The Service assumes valid inputs.
        // We should keep this check here or move it to the Service if we want it centralized.
        // For now, I'll keep it here to match the Web Controller refactor which did the check in the controller.
        if ($shop->user_id !== Auth::id()) {
            return response()->json(['message' => 'You do not own this shop'], 403);
        }

        $customer = User::findOrFail($request->customer_id);
        
        // The previous code checked if user is customer. 
        // The Service doesn't explicitly check this, but it probably should.
        // I'll add the check here to match previous logic.
        if (!$customer->isCustomer()) {
             return response()->json(['message' => 'User is not a customer'], 400);
        }

        $result = $this->visitService->recordVisit($shop, $customer);

        return response()->json($result);
    }
}
