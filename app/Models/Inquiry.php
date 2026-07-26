<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'phone',
        'description',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];
}
