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
        'landmark',
        'exchange',
        'pay_in_installments',
        'credit',
    ];

    protected $casts = [
        'images' => 'array',
        'exchange' => 'boolean',
        'pay_in_installments' => 'boolean',
        'credit' => 'boolean',
        'price' => 'decimal:2',
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
}
