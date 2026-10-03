<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'description',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];
}
