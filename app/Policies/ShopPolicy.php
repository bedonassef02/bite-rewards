<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Shop $shop): bool
    {
        return $user->id === $shop->user_id;
    }

    /**
     * Determine whether the user can scan QR codes for this shop.
     */
    public function scan(User $user, Shop $shop): bool
    {
        return $user->id === $shop->user_id;
    }
}
