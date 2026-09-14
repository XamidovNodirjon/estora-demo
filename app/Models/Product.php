<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'user_id',
        'region_id',
        'city_id',
        'name',
        'price',
        'description',
        'images',
        'phone',
        'phone_views_count',
        'floor',
        'building_floor',
        'square',
        'rooms',
        'repair',
        'sotix',
        'status',
        'is_top',
        'landmark',
        'exchange',
        'pay_in_installments',
        'credit',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'images' => 'array',
        'is_top' => 'boolean',
        'exchange' => 'boolean',
        'pay_in_installments' => 'boolean',
        'credit' => 'boolean',
        'price' => 'decimal:2',
        'latitude' => 'float',
        'longitude' => 'float',
        'phone_views_count' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class);
    }

    public function metros()
    {
        return $this->belongsToMany(Metro::class);
    }

    public function universities()
    {
        return $this->belongsToMany(University::class);
    }

    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    public function phoneViews()
    {
        return $this->hasMany(ProductPhoneView::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavoritedBy(?User $user = null): bool
    {
        $userId = $user?->id ?? \Illuminate\Support\Facades\Auth::id();
        if (!$userId) return false;
        return $this->favoritedByUsers()->where('user_id', $userId)->exists();
    }

    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }

    /**
     * Check if the product was posted by a makler / rieltor.
     */
    public function isMaklerListing(): bool
    {
        return $this->user?->isMakler() ?? false;
    }

    /**
     * Check if the product was posted by a property owner (uy egasi / client).
     */
    public function isOwnerListing(): bool
    {
        return !$this->isMaklerListing();
    }

    /**
     * Determine if the given or current user can view the phone number.
     * Rules:
     * - If listing is by a Makler: Everyone (including guests) can view phone freely.
     * - If listing is by an Owner: Requires user registration/login.
     * - The listing owner and admins can always view phone.
     */
    public function canViewPhone(?User $viewer = null): bool
    {
        // Makler listings have completely open phone access
        if ($this->isMaklerListing()) {
            return true;
        }

        $viewer = $viewer ?? \Illuminate\Support\Facades\Auth::user();

        // If guest and owner listing: strictly gated
        if (!$viewer) {
            return false;
        }

        // Listing owner themselves
        if ($viewer->id === $this->user_id) {
            return true;
        }

        // Admin / dev / manager
        $viewerRole = $viewer->role?->name ?? $viewer->type;
        if (in_array($viewerRole, ['admin', 'dev', 'manager'])) {
            return true;
        }

        // Any authenticated registered user can view owner phone
        return true;
    }

    /**
     * Get real phone or fallback to seller user phone.
     */
    public function getEffectivePhoneAttribute(): ?string
    {
        return $this->phone ?: $this->user?->phone;
    }

    /**
     * Get masked representation of phone number (e.g. +998 ** *** ** **).
     */
    public function getMaskedPhoneAttribute(): string
    {
        $raw = $this->effective_phone;
        if (!$raw) {
            return '+998 ** *** ** **';
        }
        
        $clean = preg_replace('/[^\d]/', '', $raw);
        if (strlen($clean) >= 12 && str_starts_with($clean, '998')) {
            $prefix = substr($clean, 3, 2);
            return "+998 {$prefix} *** ** **";
        }
        
        return '+998 ** *** ** **';
    }
}
