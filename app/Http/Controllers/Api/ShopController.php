<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        // Return all shops for customers to see
        return response()->json(Shop::with('owner:id,name')->get());
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isShopOwner()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visits_required' => 'integer|min:1',
        ]);

        $shop = Auth::user()->shops()->create($request->all());

        return response()->json($shop, 201);
    }

    public function show(Shop $shop)
    {
        return response()->json($shop->load('owner:id,name'));
    }

    public function update(Request $request, Shop $shop)
    {
        if (Auth::id() !== $shop->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'visits_required' => 'integer|min:1',
        ]);

        $shop->update($request->all());

        return response()->json($shop);
    }
}
