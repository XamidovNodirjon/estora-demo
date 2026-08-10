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
}
