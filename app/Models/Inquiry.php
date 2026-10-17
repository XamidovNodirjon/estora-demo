<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'description',
        'requested_plan',
        'requested_period',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    /**
     * Arizani yuborgan foydalanuvchi (tizimga kirgan holda yuborilgan bo'lsa).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tarifga obuna bo'lish so'rovi (kabinetdagi "Obuna olish" tugmasidan).
     */
    public function isSubscriptionRequest(): bool
    {
        return filled($this->requested_plan);
    }
}
