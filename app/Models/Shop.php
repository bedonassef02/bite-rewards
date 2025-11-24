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
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($shop) {
            if (empty($shop->slug)) {
                $shop->slug = static::generateUniqueSlug($shop->name);
            }
        });
        
        static::updating(function ($shop) {
            if ($shop->isDirty('name') && empty($shop->slug)) {
                $shop->slug = static::generateUniqueSlug($shop->name);
            }
        });
    }

    protected static function generateUniqueSlug($name)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
