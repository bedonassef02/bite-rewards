<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'visits_required',
        'logo_path',
        'reward_name',
        'reward_image_path',
        'plan',
    ];

    public function scopePremium($query)
    {
        return $query->where('plan', 'premium');
    }

    public function isPremium(): bool
    {
        return $this->plan === 'premium';
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
