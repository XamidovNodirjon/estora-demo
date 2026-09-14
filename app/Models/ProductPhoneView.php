<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoneView extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'viewer_id',
        'seller_id',
        'seller_role',
        'ip_address',
        'user_agent',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
