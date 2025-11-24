<?php

namespace App\Services;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ShopService
{
    /**
     * Create a new shop for the user.
     */
    public function createShop(User $user, array $data): Shop
    {
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $data['logo_path'] = $data['logo']->store('logos', 'public');
        }

        if (isset($data['reward_image']) && $data['reward_image'] instanceof UploadedFile) {
            $data['reward_image_path'] = $data['reward_image']->store('rewards', 'public');
        }

        return $user->shops()->create($data);
    }

    /**
     * Update an existing shop.
     */
    public function updateShop(Shop $shop, array $data): bool
    {
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            // Delete old logo if exists
            if ($shop->logo_path) {
                Storage::disk('public')->delete($shop->logo_path);
            }
            $data['logo_path'] = $data['logo']->store('logos', 'public');
        }

        if (isset($data['reward_image']) && $data['reward_image'] instanceof UploadedFile) {
            // Delete old reward image if exists
            if ($shop->reward_image_path) {
                Storage::disk('public')->delete($shop->reward_image_path);
            }
            $data['reward_image_path'] = $data['reward_image']->store('rewards', 'public');
        }

        return $shop->update($data);
    }
}
