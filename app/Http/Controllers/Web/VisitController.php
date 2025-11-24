<?php

namespace App\Http\Controllers\Web;

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

    public function store(StoreVisitRequest $request)
    {
        $shop = Shop::findOrFail($request->shop_id);
        
        if ($shop->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $customer = User::findOrFail($request->customer_id);

        $result = $this->visitService->recordVisit($shop, $customer);

        return response()->json($result);
    }
}
