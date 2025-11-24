<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait ManagesVisits
{
    /**
     * Record a visit using the service
     */
    protected function recordVisitData(array $validatedData)
    {
        return $this->visitService->recordVisit($validatedData);
    }

    /**
     * Get visit history for a shop and user
     */
    protected function getVisitHistory($shop, $user, $limit = null)
    {
        $query = $shop->visits()
            ->where('user_id', $user->id)
            ->latest('visited_at');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }
}
